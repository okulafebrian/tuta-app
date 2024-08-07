<?php

namespace App\Services\JNT;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Jnt
{
    protected mixed $username;
    protected mixed $api_key;
    protected mixed $order_key;
    protected mixed $order_url;
    protected mixed $tariff_check_key;
    protected mixed $tariff_check_url;
    protected mixed $track_key;
    protected mixed $track_url;
    protected mixed $cancel_key;
    protected mixed $cancel_url;
    
    public function __construct()
    {
        $this->username = config('services.jnt.username');
        $this->api_key = config('services.jnt.api_key');
        $this->order_key = config('services.jnt.order_key');
        $this->order_url = config('services.jnt.order_url');
        $this->tariff_check_key = config('services.jnt.tariff_check_key');
        $this->tariff_check_url = config('services.jnt.tariff_check_url');
        $this->track_key = config('services.jnt.track_key');
        $this->track_url = config('services.jnt.track_url');
        $this->cancel_key = config('services.jnt.cancel_key');
        $this->cancel_url = config('services.jnt.cancel_url');
    }
    
    /**
     * @param $orderData
     * @return array|mixed
     */
    public function createOrder($orderData)
    {
        $data = [
            'username' => $this->username,
            'api_key' => $this->api_key,
            'orderid' => $orderData['orderid'],
            'shipper_name' => $orderData['shipper_name'],
            'shipper_contact' => $orderData['shipper_contact'],
            'shipper_phone' => $orderData['shipper_phone'],
            'shipper_addr' => $orderData['shipper_addr'],
            'origin_code' => $orderData['origin_code'],
            'receiver_name' => $orderData['receiver_name'],
            'receiver_phone' => $orderData['receiver_phone'],
            'receiver_addr' => $orderData['receiver_addr'],
            'receiver_zip' => $orderData['receiver_zip'],
            'destination_code' => $orderData['destination_code'],
            'receiver_area' => $orderData['receiver_area'],
            'qty' => $orderData['qty'],
            'weight' => $orderData['qty'],
            'goodsdesc' => 'Sepatu',
            'servicetype' => '1',
            'insurance' => '',
            'orderdate' => Carbon::now()->format('Y-m-d H:i:s'),
            'item_name' => 'Sepatu',
            'cod' => $orderData['cod'],
            'sendstarttime' => $orderData['sendstarttime'],
            'sendendtime' => $orderData['sendendtime'],
            'expresstype' => '1',
            'goodsvalue' => $orderData['goodsvalue'],
        ];
        
        $dataJson = json_encode(['detail' => array($data)]);
        
        $dataRequest = [
            'data_param' => $dataJson,
            'data_sign' => base64_encode(md5($dataJson . $this->order_key))
        ];
        
        return Http::asForm()->post($this->order_url, $dataRequest)->json();
    }
    
    /**
     * @param $weight
     * @param $sendSiteCode
     * @param $destAreaCode
     * @return array|mixed
     */
    public function tariffCheck($weight, $sendSiteCode, $destAreaCode)
    {
        $data = [
            'weight' => $weight,
            'sendSiteCode' => $sendSiteCode,
            'destAreaCode' => $destAreaCode,
            'cusName' => 'TUTAMANDIRIINDO',
            'productType' => 'EZ'
        ];
        
        $dataJson = json_encode($data);
        
        $dataRequest = [
            'data' => $dataJson,
            'sign' => base64_encode(md5($dataJson . $this->tariff_check_key))
        ];
        
        return Http::asForm()->post($this->tariff_check_url, $dataRequest)->json();
    }
    
    /**
     * @param $awb
     * @return array|mixed
     */
    public function trackOrder($awb)
    {
        $dataRequest = [
            'awb' => $awb,
            'eccompanyid' => $this->username
        ];
        
        return Http::withBasicAuth($this->username, $this->track_key)->post($this->track_url, $dataRequest)->json();
    }
    
    /**
     * @param $orderId
     * @return array|mixed
     */
    public function cancelOrder($orderId)
    {
        $data = [
            'username' => $this->username,
            'api_key' => $this->api_key,
            'orderid' => $orderId,
            'remark' => 'Cancelled by TUTA'
        ];
        
        $dataJson = json_encode(['detail' => array($data)]);
        
        $dataRequest = [
            'data_param' => $dataJson,
            'data_sign' => base64_encode(md5(($dataJson) . $this->cancel_key))
        ];
        
        return Http::asForm()->post($this->cancel_url, $dataRequest)->json();
    }
}
