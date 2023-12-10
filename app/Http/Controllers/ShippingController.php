<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShippingResource;
use App\Models\Order;
use App\Models\Shipping;
use App\Services\JNT\Jnt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Milon\Barcode\Facades\DNS1DFacade;


class ShippingController extends Controller
{
    public function tariffCheck(Request $request)
    {
        $jnt = new Jnt();
        
        $weight = $request->query('weight');
        $sendSiteCode = 'TANGERANG';
        $destAreaCode = $request->query('district');
        
        $response = $jnt->tariffCheck($weight, $sendSiteCode, $destAreaCode);
        
        return $response;
    }

    public function store(Order $order, Request $request)
    {
        $request->validate([
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'time' => 'required',
            'address' => 'required'
        ]);
        
        $code = Shipping::generateCode();

        if ($request->time == 'afternoon') {
            $sendstarttime = Carbon::create($request->year, $request->month, $request->day, 13, 0, 0);
            $sendendtime= Carbon::create($request->year, $request->month, $request->day, 17, 59, 0);
        } else {
            $sendstarttime = Carbon::create($request->year, $request->month, $request->day, 18, 0, 0);
            $sendendtime= Carbon::create($request->year, $request->month, $request->day, 22, 00, 0);
        }
        
        $orderData = [
            'orderid' => $code,
            'shipper_name' => $request->address['name'],
            'shipper_contact' => $request->address['name'],
            'shipper_phone' => '+' . $request->address['phone_number'],
            'shipper_addr' => $request->address['detail'],
            'origin_code' => $request->address['city']['code'],
            'receiver_name' => $order->receiver_name,
            'receiver_phone' => '+' . $order->receiver_phone,
            'receiver_addr' => $order->receiver_address,
            'receiver_zip' => $order->zipCode->name,
            'destination_code' => $order->city->code,
            'receiver_area' => $order->district->code,
            'qty' => $order->total_quantity,
            'cod' => $order->payment_type == 'cod' ? $order->total_payment : '',
            'goodsvalue' => $order->total_price,
            'sendstarttime' => $sendstarttime->format('Y-m-d H:i:s'),
            'sendendtime' => $sendendtime->format('Y-m-d H:i:s')
        ];
        
        $jnt = new Jnt();
        $res = $jnt->createOrder($orderData);
        
        $status = $res['detail'][0]['status'];
        
        if ($status == 'Error') {
            $reason = $res['detail'][0]['reason'];

            return back()->with(['error' => $reason]);
        }
        
        Shipping::create([
            'order_id' => $order['id'],
            'code' => $code,
            'awb_no' => $res['detail'][0]['awb_no'],
            'des_code' => $res['detail'][0]['desCode'],
            'send_start_time' => $sendstarttime,
            'send_end_time' => $sendendtime,
            'etd' => $res['detail'][0]['etd'],
        ]);

        $order->update([
            'status' => Order::SHIPPING_ARRANGED,
        ]);

        return back()->with(['success' => 'Pengiriman berhasil dibuat.']);
    }

    public function track($awbNo)
    {
        $jnt = new Jnt();
        $response = $jnt->trackOrder($awbNo);
        
        return $response;
    }

    public function receipt(Shipping $shipping)
    {
        $orderBarcode = DNS1DFacade::getBarcodePNG($shipping->order->code, 'C39');
        $jntBarcode = DNS1DFacade::getBarcodePNG($shipping->awb_no, 'C39');
        
        return inertia('Shipping/Receipt', [
            'shipping' => ShippingResource::make($shipping),
            'jntBarcode' => $jntBarcode,
            'orderBarcode' => $orderBarcode
        ]);
    }
}
