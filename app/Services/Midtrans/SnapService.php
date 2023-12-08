<?php

namespace App\Services\Midtrans;

use Carbon\Carbon;
use Exception;
use Midtrans\Snap;

class SnapService extends Midtrans
{
    /**
     * @param $transaction
     * @return object
     * @throws Exception
     */
    public function createTransaction($order)
    {
        $itemDetails = [];
        
        foreach ($order->getOrderDetails() as $orderDetail) {
            $itemDetails[] = [
                'id' => $orderDetail->id,
                'price' => $orderDetail->price,
                'quantity' => $orderDetail->quantity,
                'name' => substr($orderDetail->name, 0, 20)
            ];
        }

        $itemDetails[] = [
            'id' => 'SF',
            'price' => $order->shipping_fee,
            'quantity' => 1,
            'name' => "Total Ongkos Kirim"
        ];
        
        $params = [
            'transaction_details' => [
                'order_id' => $order->code,
                'gross_amount' => $order->total_payment,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => null,
                'phone' => $order->user->phone,
            ],
            'credit_card' => [
                'secure' => true
            ],
            'callbacks' => [
                'finish' => config('app.url') . '/orders/confirmation'
            ],
            'expiry' => [
                'start_time' => Carbon::now()->format('Y-m-d H:i:s O'),
                'unit' => 'minutes',
                'duration' => 1
            ]
        ];
        
        $snap = Snap::createTransaction($params);
        
        $order->payment_token = $snap->token;
        $order->redirect_url = $snap->redirect_url;
        $order->save();
        
        return $snap;
    }
}
