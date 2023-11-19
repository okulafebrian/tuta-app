<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentNotification;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function confirmation($status)
    {
        return inertia('Payment/Confirmation', [
            'status' => $status 
        ]);
    }

    public function notification(PaymentNotification $request)
    {
        $input = $request->all();
        dd($input);
        
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
