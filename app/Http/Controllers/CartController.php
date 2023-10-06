<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Color;
use App\Models\Shoe;
use App\Models\ShoeVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __invoke()
    {
        $cart = session('cart');
        $total = 0;
        $shoes = [];

        if($cart) {
            foreach ($cart as $key => $value) {
                list($shoeId, $colorId, $sizeId) = explode('-', $key);
                
                $shoe = DB::table('shoes')
                        ->join('shoe_variants', 'shoes.id', 'shoe_variants.shoe_id')
                        ->join('categories', 'shoes.category_id', 'categories.id')
                        ->join('sizes', 'shoe_variants.size_id', 'sizes.id')
                        ->join('colors', 'shoe_variants.color_id', 'colors.id')
                        ->select('shoe_variants.id as shoe_variant_id', 'shoes.code', 'shoes.name', 'shoes.price', 'shoes.discount_price', 'categories.name AS category', 'colors.name AS color', 'sizes.name AS size')
                        ->where('shoe_id', $shoeId)
                        ->where('color_id', $colorId)
                        ->where('size_id', $sizeId)
                        ->first();

                $shoe->key = $key;
                $shoe->quantity = $value;
                $shoe->subTotal = $shoe->discount_price ? $shoe->discount_price * $value : $shoe->price * $value;
                $total += $shoe->subTotal;
                
                $shoes[] = $shoe;
            }
        }
        
        return inertia('Cart', [
            'shoes' => $shoes,
            'total' => $total
        ]);
    }

    public function add(CartRequest $request)
    {
        $shoetId = $request->input('shoe_id');
        $colorId = $request->input('color');
        $sizeId = $request->input('size');
        $quantity = $request->input('quantity');
        
        $cartKey = "$shoetId-$colorId-$sizeId";

        $cart = session('cart', []);

        $cart[$cartKey] = $quantity;

        session(['cart' => $cart]);

        return redirect()->back();
    }

    public function remove($key)
    {
        $cart = session('cart', []);

        unset($cart[$key]);

        session(['cart' => $cart]);

        return redirect()->back();
    }
}
