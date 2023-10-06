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
     * @param $orderId
     * @return array|mixed
     */
    public function createOrder($orderId)
    {
        $data = [
            'username' => $this->username,
            'api_key' => $this->api_key,
            'orderid' => $orderId,
            'shipper_name' => 'PENGIRIM',
            'shipper_contact' => 'PENGIRIM',
            'shipper_phone' => '+628123456789',
            'shipper_addr' => 'JL. Pengirim no.88, RT/RW:001/010, Pluit',
            'origin_code' => 'JKT',
            'receiver_name' => 'PENERIMA',
            'receiver_phone' => '+62812348888',
            'receiver_addr' => 'JL. Penerima no.1, RT/RW:04/07, Sidoarjo',
            'receiver_zip' => '40123',
            'destination_code' => 'JKT',
            'receiver_area' => 'JKT001',
            'qty' => '1',
            'weight' => '1',
            'goodsdesc' => 'TESTING!!',
            'servicetype' => '1',
            'insurance' => '122',
            'orderdate' => Carbon::now(),
            'item_name' => 'topi',
            'cod' => '120000',
            'sendstarttime' => Carbon::now(),
            'sendendtime' => Carbon::now(),
            'expresstype' => '1',
            'goodsvalue' => '1000',
        ];
        
        $dataJson = json_encode(['detail' => array($data)]);
        
        $dataRequest = [
            'data_param' => $dataJson,
            'data_sign' => base64_encode(md5(($dataJson) . $this->order_key))
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
            'cusName' => 'Budi',
            'productType' => 'EZ'
        ];
        
        $dataJson = json_encode(['detail' => array($data)]);
        
        $dataRequest = [
            'data' => $dataJson,
            'sign' => base64_encode(md5(($dataJson) . $this->tariff_check_key))
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
            'remark' => 'Cancel by e-commerce'
        ];
        
        $dataJson = json_encode(['detail' => array($data)]);
        
        $dataRequest = [
            'data_param' => $dataJson,
            'data_sign' => base64_encode(md5(($dataJson) . $this->cancel_key))
        ];
        
        return Http::asForm()->post($this->cancel_url, $dataRequest)->json();
    }
}
