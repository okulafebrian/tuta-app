<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentNotification;
use App\Http\Resources\OrderResource;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductVariant;
use App\Services\JNT\Jnt;
use App\Services\Midtrans\SnapService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{   
    /**
     * @var SnapService
     */
    protected $snapService;
    
    /**
     * @param  SnapService  $snapService
     */

    public function __construct(SnapService $snapService)
    {
        $this->middleware(['admin.auth'])->only('manage', 'cancel');
        $this->middleware(['user.auth', 'verified.phone'])->only(['index', 'store', 'pending', 'confirmation']);
        $this->snapService = $snapService;
    }

    public function index(Request $request)
    {
        $statusMapping = [
            'dikemas' => [Order::PAYMENT_SUCCESS, Order::SHIPPING_ARRANGED],
            'dikirim' => [Order::ORDER_SHIPPED],
            'selesai' => [Order::ORDER_COMPLETED],
            'dibatalkan' => [Order::ORDER_CANCELLED],
        ];

        $code = $statusMapping[$request->input('status')] ?? null;

        $query = Order::where('user_id', auth()->user()->id)
                    ->whereNotIn('status', [Order::PAYMENT_PENDING, Order::PAYMENT_EXPIRED]);

        if ($code) {
            $query->whereIn('status', $code);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->get();
        
        return inertia('Orders/Index', [
            'orders' => OrderResource::collection($orders)
        ]);
    }

    public function manage(Request $request)
    {
        $statusMapping = [
            'perlu_dikirim' => [Order::PAYMENT_SUCCESS, Order::SHIPPING_ARRANGED],
            'dikirim' => [Order::ORDER_SHIPPED],
            'selesai' => [Order::ORDER_COMPLETED],
            'pembatalan' => [Order::ORDER_CANCELLED],
        ];
        
        $code = $statusMapping[$request->input('status')] ?? null;
                
        $query = Order::whereNotIn('status', [Order::PAYMENT_PENDING, Order::PAYMENT_EXPIRED]);
       
        if ($code) {
            $query->whereIn('status', $code);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->get();

        return inertia('Orders/Manage', [
            'orders' => OrderResource::collection($orders)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_type' => 'required',
            'address_id' => 'required',
            'shipping_fee' => 'required',
            'total_payment' => 'required',
        ]);
        
        $carts = Cart::query()
                ->join('product_variants', 'carts.product_variant_id', 'product_variants.id')
                ->join('colors', 'product_variants.color_id', 'colors.id')
                ->join('sizes', 'product_variants.size_id', 'sizes.id')
                ->join('products', 'product_variants.product_id', 'products.id')
                ->join('categories', 'products.category_id', 'categories.id')
                ->select('carts.id', 'product_variants.id AS product_variant_id', 'products.name', 'categories.name AS category', 'products.code', 'products.price', 'products.discount_price', 'products.is_discount', 'colors.name AS color', 'sizes.name AS size', 'product_variants.stock', 'product_variants.photo AS variantPhoto', 'carts.quantity')
                ->where('carts.user_id', auth()->user()->id)
                ->get();
        
        if ($carts->count() < 1) {
            return back();
        }

        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->stock) return back();
        }
        
        $order = DB::transaction(function () use($request, $carts) {
            $address = Address::find($request->address_id);

            $order = Order::create([
                'user_id' => auth()->user()->id,
                'code' => Order::generateCode(),
                'total_price' => $request->total_price,
                'shipping_fee' => $request->shipping_fee,
                'total_payment' => $request->total_payment,
                'total_quantity' => $carts->sum('quantity'),
                'payment_type' => $request->payment_type == 'cod' ? 'cod' : null,
                'status' => $request->payment_type == 'cod' ? Order::PAYMENT_SUCCESS : Order::PAYMENT_PENDING,
                'receiver_name' => $address->name,
                'receiver_phone' => $address->phone_number,
                'receiver_address' => $address->detail,
                'province_id' => $address->province_id,
                'city_id' => $address->city_id,
                'district_id' => $address->district_id,
                'zip_code_id' => $address->zip_code_id,
            ]);
            
            foreach ($carts as $cart) {
                $price = $cart->is_discount ? $cart->discount_price : $cart->price;
                
                $orderDetails[] = [
                    'order_id' => $order->id,
                    'product_variant_id' => $cart->product_variant_id,
                    'name' => $cart->name,
                    'code' => $cart->code,
                    'category' => $cart->category,
                    'size' => $cart->size,
                    'color' => $cart->color,
                    'price' => $price,
                    'photo' => $cart->variantPhoto,
                    'quantity' => $cart->quantity,
                    'sub_total' => $cart->quantity * $price
                ];
                
                ProductVariant::find($cart->product_variant_id)->update([
                    'stock' => $cart->stock - $cart->quantity
                ]);
            }
            
            OrderDetail::insert($orderDetails);

            Cart::where('user_id', auth()->user()->id)->delete();

            return $order;
        });
        
        if ($request->payment_type == 'cashless') {
            $snap = $this->snapService->createTransaction($order);

            return inertia()->location($snap->redirect_url);
        }
        
        return redirect()->route('orders.confirmation', [
            'order_id' => $order->code,
            'transaction_status' => 'settlement'
        ]);
    }

    public function invoice(Order $order)
    {
        return inertia('Orders/Invoice', [
            'order' => OrderResource::make($order)
        ]);
    }

    public function cancel(Order $order)
    {
        if ($order->shipping) {
            $jnt = new Jnt();
            $res = $jnt->cancelOrder($order->shipping->code);

            $status = $res['detail'][0]['status'];
            $reason = $res['detail'][0]['reason'];

            if ($status == 'Error') {
                return back()->with(['error' => $reason]);
            }
        }
        
        $order->update([
            'status' => Order::ORDER_CANCELLED,
            'cancelled_at' => Carbon::now()
        ]);

        return back()->with(['success' => 'Pesanan berhasil dibatalkan.']);
    }
 
    public function pending()
    {           
        $orders = Order::where('user_id', auth()->user()->id)
                    ->where('status', Order::PAYMENT_PENDING)
                    ->get();

        return inertia('Orders/Pending', [
            'orders' => OrderResource::collection($orders)
        ]);
    }

    public function confirmation(Request $request)
    {
        $input = $request->all();

        if (in_array($input['transaction_status'], ['settlement', 'capture'])) {
            $status = Order::PAYMENT_SUCCESS;
        } else if (in_array($input['transaction_status'], ['deny', 'cancel', 'failure', 'expire'])) {
            $status = Order::ORDER_CANCELLED;
        } else if ($input['transaction_status'] == 'pending') {
            $status = Order::PAYMENT_PENDING;
        }

        $order = Order::where('code', ($input['order_id']))->first();
        
        return inertia('Orders/Confirmation', [
            'status' => $status,
            'order' => $order
        ]);
    }

    public function notification(PaymentNotification $request)
    {
        $input = $request->all();
        
        if (in_array($input['transaction_status'], ['settlement', 'capture']) && $input['fraud_status'] == 'accept') {
            Order::where('code', $input['order_id'])->update([
                'status' => Order::PAYMENT_SUCCESS,
                'paid_at' => Carbon::now(),
                'payment_type' => $input['payment_type']
            ]);    
            
            return response()->json([
                'status' => 'Notification Success',
                'code' => 200,
            ]);
        } else if (in_array($input['transaction_status'], ['deny', 'cancel', 'failure'])) {
            $order = Order::where('code', $input['order_id'])->first();

            $order->update([
                'status' => Order::ORDER_CANCELLED,
                'cancelled_at' => Carbon::now()
            ]);

            foreach ($order->orderDetails as $orderDetail) {
                $productVariant = $orderDetail->productVariant;
                
                $productVariant->update([
                    'stock' => $productVariant->stock + $orderDetail->quantity
                ]);
            }
            
            return response()->json([
                'status' => 'Notification Cancelled',
                'code' => 200,
            ]);
        } else if ($input['transaction_status'] == 'expire') {
            $order = Order::where('code', $input['order_id'])->first();

            $order->update([
                'status' => Order::PAYMENT_EXPIRED,
                'expired_at' => Carbon::now()
            ]);

            foreach ($order->orderDetails as $orderDetail) {
                $productVariant = $orderDetail->productVariant;
                
                $productVariant->update([
                    'stock' => $productVariant->stock + $orderDetail->quantity
                ]);
            }
            
            return response()->json([
                'status' => 'Notification Expired',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 'Can\'t not process notification!',
                'code' => 404,
            ]);
        }
    }
}
