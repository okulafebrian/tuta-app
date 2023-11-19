<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Services\JNT\Jnt;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function tariffCheck(Request $request)
    {
        $jnt = new Jnt();
        
        $weight = $request->query('weight');
        $sendSiteCode = 'JAKARTA';
        $destAreaCode = $request->query('district');
        
        $fee = $jnt->tariffCheck($weight, $sendSiteCode, $destAreaCode);

        return $fee;
    }
}
