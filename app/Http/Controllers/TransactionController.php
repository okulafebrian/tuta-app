<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentNotification;
use App\Http\Requests\PaymentNotificationRequest;
use App\Jobs\ExpiredTransaction;
use App\Models\Shipping;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Services\JNT\Jnt;
use App\Services\Midtrans\SnapService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class TransactionController
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
        $this->snapService = $snapService;
    }
    
    /**
     * @return Response|void
     * @throws Exception
     */
    public function create()
    {
        $cart = session('cart');
        $total = 0;
        $totalDiscount = 0;
        $totalQuantity = 0;
        $subTotal = 0;
        
        $transactionDetails = [];
        
        if ($cart) {
            foreach ($cart as $key => $value) {
                list($shoeId, $colorId, $sizeId) = explode('-', $key);
                
                $shoe = DB::table('shoes')
                    ->join('shoe_variants', 'shoes.id', 'shoe_variants.shoe_id')
                    ->join('categories', 'shoes.category_id', 'categories.id')
                    ->join('sizes', 'shoe_variants.size_id', 'sizes.id')
                    ->join('colors', 'shoe_variants.color_id', 'colors.id')
                    ->select('shoe_variants.id as shoe_variant_id', 'shoes.code', 'shoes.name', 'shoes.price',
                        'shoes.discount_price', 'categories.name AS category', 'colors.name AS color',
                        'sizes.name AS size')
                    ->where('shoe_id', $shoeId)
//                        ->where('color_id', $colorId)
//                        ->where('size_id', $sizeId)
                    ->first();
                
                $totalDiscount += $shoe->discount_price ? $shoe->price - $shoe->discount_price : 0;
                $totalQuantity += $value;
                $subTotal += $shoe->discount_price ? $shoe->discount_price * $value : $shoe->price * $value;
                
                $transactionDetails[] = [
                    'shoe_id' => $shoeId,
                    'price' => $shoe->discount_price ? $shoe->discount_price : $shoe->price,
                    'discount_price' => $shoe->discount_price ? $shoe->price - $shoe->discount_price : 0,
                    'quantity' => (int) $value,
                    'sub_total' => $shoe->discount_price ? $shoe->discount_price * $value : $shoe->price * $value
                ];
            }
            
            $transaction = Transaction::create([
                'code' => 'TT-' . Str::random(10),
                'total_price' => $subTotal,
                'total_discount_price' => $totalDiscount,
                'total_quantity' => $totalQuantity,
                'status' => Transaction::PENDING
            ]);
            
//            $jnt = new Jnt();
//            $res = $jnt->createOrder($transaction->code);
//
//            dd($res['detail'][0]['awb_no']);
            
            foreach ($transactionDetails as $key => $transactionDetail) {
                $transactionDetails[$key]['transaction_id'] = $transaction->id;
            }
            
            TransactionDetail::insert($transactionDetails);
            
            $snap = $this->snapService->createTransaction($transaction);
            
            ExpiredTransaction::dispatch($transaction->code)
                ->delay(Carbon::now()->addMinutes(61));
            
            session(['cart' => []]);
            
            return Inertia::location($snap->redirect_url);
        } else {
            abort(403, 'Sorry we can not process your transaction, please try again later!');
        }
    }
    
    /**
     * @param  PaymentNotification  $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function notification(PaymentNotification $request)
    {
        $input = $request->all();
        
        if (in_array($input['transaction_status'], ['settlement', 'capture']) && $input['fraud_status'] == 'accept') {
            Transaction::where('code', $input['order_id'])->update([
                'status' => Transaction::SUCCESS,
                'completed_at' => Carbon::now()
            ]);
            
            $transaction = Transaction::where('code', $input['order_id'])->firstOrFail();
            
            $jnt = new Jnt();
            $res = $jnt->createOrder($input['order_id']);
            
            Shipping::create([
                'transaction_id' => $transaction->id,
                'awb_no' => $res['detail'][0]['awb_no']
            ]);
            
            return response()->json([
                'status' => 'Notification Success',
                'code' => 200,
            ]);
        } else if (in_array($input['transaction_status'], ['deny', 'cancel', 'failure'])) {
            Transaction::where('code', $input['order_id'])->update([
                'status' => Transaction::CANCELED,
                'canceled_at' => Carbon::now()
            ]);
            
            return response()->json([
                'status' => 'Notification Canceled',
                'code' => 200,
            ]);
        } else if ($input['transaction_status'] == 'expire') {
            Transaction::where('code', $input['order_id'])->update([
                'status' => Transaction::EXPIRED,
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
