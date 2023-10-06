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
    public function createTransaction($transaction)
    {
        $itemDetails = [];
        
        foreach ($transaction->getTransactionDetails() as $transactionDetail) {
            $itemDetails[] = [
                'id' => $transactionDetail->id,
                'price' => $transactionDetail->price,
                'quantity' => $transactionDetail->quantity,
                'name' => substr($transactionDetail->getShoe()->name, 0, 20)
            ];
        }
        
        $params = [
            'transaction_details' => [
                'order_id' => $transaction->code,
                'gross_amount' => $transaction->total_price,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => 'User',
                'email' => 'user@mailinator.com',
                'phone' => '081122334455',
            ],
            'credit_card' => [
                'secure' => true
            ],
            'callbacks' => [
                'finish' => config('app.url')
            ],
            'expiry' => [
                'start_time' => Carbon::now()->format('Y-m-d H:i:s O'),
                'unit' => 'minutes',
                'duration' => 60
            ]
        ];
        
        $snap = Snap::createTransaction($params);
        
        $transaction->payment_token = $snap->token;
        $transaction->save();
        
        return $snap;
    }
}
