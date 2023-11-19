<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentNotification;
use App\Jobs\ExpiredOrder;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\ShoeVariant;
use App\Services\JNT\Jnt;
use App\Services\Midtrans\SnapService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

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
        $this->middleware(['admin.auth'])->only('manage');
        $this->middleware(['user.auth'])->only(['index', 'store']);
        $this->snapService = $snapService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusMapping = [
            'menunggu_pembayaran' => 0,
            'menunggu_konfirmasi' => 1,
            'dibatalkan' => 2,
            'diproses' => 3,
            'dikirim' => 4,
            'selesai' => 5,
        ];

        $code = $statusMapping[$request->input('status')] ?? null;

        $query = Order::with('orderDetails', 'shipping', 'user', 'district', 'city')
                    ->where('status', '!=', 0);

        if ($code) {
            $query->where('status', $code);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->get();

        return inertia('Orders/Index', [
            'orders' => $orders
        ]);
    }

    public function test() {
        
    }

    public function manage(Request $request)
    {
        $statusMapping = [
            'baru' => 1,
            'siap_dikirim' => 3,
            'dalam_pengiriman' => 4,
            'selesai' => 5,
            'dibatalkan' => 2,
        ];

        $code = $statusMapping[$request->input('status')] ?? null;

        $query = Order::with('orderDetails', 'shipping', 'user', 'district', 'city')
                    ->where('status', '!=', 0);
       
        if ($code) {
            $query->where('status', $code);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->get();

        return inertia('Orders/Manage', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carts = Cart::query()
                ->join('shoe_variants', 'carts.shoe_variant_id', 'shoe_variants.id')
                ->join('colors', 'shoe_variants.color_id', 'colors.id')
                ->join('sizes', 'shoe_variants.size_id', 'sizes.id')
                ->join('shoes', 'shoe_variants.shoe_id', 'shoes.id')
                ->join('categories', 'shoes.category_id', 'categories.id')
                ->select('carts.id', 'shoe_variants.id AS shoe_variant_id', 'shoes.name', 'categories.name AS category', 'shoes.code', 'shoes.price', 'shoes.discount_price', 'shoes.is_discount', 'colors.name AS color', 'sizes.name AS size', 'shoe_variants.stock', 'shoe_variants.photo AS variantPhoto', 'carts.quantity')
                ->where('carts.user_id', auth()->user()->id)
                ->get();
        
        if ($carts->count() < 1) {
            return redirect()->back();
        }

        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->stock) {
                return redirect()->back();
            }
        }

        $request->validate([
            'payment_method' => 'required',
            'address_id' => 'required',
            'shipping_fee' => 'required',
            'total_payment' => 'required',
        ]);
        
        $order = DB::transaction(function () use($request, $carts) {
            $address = Address::find($request->address_id);

            $order = Order::create([
                'user_id' => auth()->user()->id,
                // 'code' => Order::orderID(),
                'code' => 'TT-' . Str::random(10),
                'cod' => $request->payment_method === 'cod' ?? false,
                'total_price' => $request->total_price,
                'shipping_fee' => $request->shipping_fee,
                'total_payment' => $request->total_payment,
                'total_quantity' => $carts->sum('quantity'),
                'status' => $request->payment_method === 'cod' ? Order::PAYMENT_SUCCESS : Order::PAYMENT_PENDING,
                'accepted_at' => $request->payment_method === 'cod' ? now() : null,
                'receiver_name' => $address->name,
                'receiver_phone' => $address->phone,
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
                    'shoe_variant_id' => $cart->shoe_variant_id,
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
                
                ShoeVariant::find($cart->shoe_variant_id)->update([
                    'stock' => $cart->stock - $cart->quantity
                ]);
            }
            
            OrderDetail::insert($orderDetails);

            Cart::where('user_id', auth()->user()->id)->delete();

            return $order;
        });
        
        if ($request->payment_method === 'cashless') {
            $snap = $this->snapService->createTransaction($order);

            ExpiredOrder::dispatch($order->code)
                ->delay(Carbon::now()->addMinutes(61));

            return Inertia::location($snap->redirect_url);
        }
        
        return redirect()->route('orders.confirmation', $order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
    
    public function pending()
    {           
        $orders = Order::with('orderDetails', 'shipping', 'user', 'district', 'city')
                    ->where('user_id', auth()->user()->id)
                    ->where('status', 0)
                    ->get();

        return inertia('Orders/Pending', [
            'orders' => $orders
        ]);
    }

    public function confirmation(Order $order)
    {
        $status = $order->status;

        return inertia('Orders/Confirmation', [
            'status' => $status 
        ]);
    }

    public function accept(Order $order)
    {
        $orderData = [
            'orderid' => $order->code,
            'receiver_name' => $order->receiver_name,
            'receiver_phone' => $order->receiver_phone,
            'receiver_addr' => $order->receiver_address,
            'receiver_zip' => $order->zipCode->name,
            'destination_code' => $order->city->code,
            'receiver_area' => $order->district->code,
            'qty' => $order->total_quantity,
            'cod' => $order->cod ? $order->total_payment : '',
            'goodsvalue' => $order->total_price,
        ];
        
        $jnt = new Jnt();
        $res = $jnt->createOrder($orderData);
        
        Shipping::create([
            'order_id' => $order->id,
            'awb_no' => $res['detail'][0]['awb_no']
        ]);

        $order->update([
            'status' => Order::ORDER_ACCEPTED,
            'accepted_at' => now()
        ]);

        return redirect()->back();
    }

    public function notification(PaymentNotification $request)
    {
        $input = $request->all();
        
        if (in_array($input['transaction_status'], ['settlement', 'capture']) && $input['fraud_status'] == 'accept') {
            Order::where('code', $input['order_id'])->update([
                'status' => Order::PAYMENT_SUCCESS,
                'completed_at' => Carbon::now()
            ]);
            
            return response()->json([
                'status' => 'Notification Success',
                'code' => 200,
            ]);
        } else if (in_array($input['transaction_status'], ['deny', 'cancel', 'failure'])) {
            Order::where('code', $input['order_id'])->update([
                'status' => Order::ORDER_CANCELED,
                'canceled_at' => Carbon::now()
            ]);
            
            return response()->json([
                'status' => 'Notification Canceled',
                'code' => 200,
            ]);
        } else if ($input['transaction_status'] == 'expire') {
            Order::where('code', $input['order_id'])->update([
                'status' => Order::ORDER_CANCELED,
                'expired_at' => Carbon::now()
            ]);
            
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
