<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Province;
use App\Models\ShoeVariant;
use App\Services\JNT\Jnt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['user.auth', 'verified.phone']);
    }

    public function index(Request $request)
    {                
        $carts = Cart::query()
                ->join('shoe_variants', 'carts.shoe_variant_id', 'shoe_variants.id')
                ->join('colors', 'shoe_variants.color_id', 'colors.id')
                ->join('sizes', 'shoe_variants.size_id', 'sizes.id')
                ->join('shoes', 'shoe_variants.shoe_id', 'shoes.id')
                ->join('categories', 'shoes.category_id', 'categories.id')
                ->select('carts.id', 'shoes.id AS shoe_id', 'categories.slug AS category_slug', 'shoes.slug AS shoe_slug', 'shoes.name', 'shoes.code', 'shoes.price', 'shoes.discount_price', 'shoes.discount', 'shoes.is_discount', 'colors.name AS color', 'sizes.name AS size', 'shoe_variants.stock', 'shoe_variants.photo AS variantPhoto', 'carts.quantity')
                ->where('carts.user_id', auth()->user()->id)
                ->get();
        
        $totalPrice = 0;
        
        foreach ($carts as $cart) {
            if (!$cart->variantPhoto) {
                $path = 'public/shoes/' . $cart->code . '/main/';
                $files = Storage::files($path);

                $cart['mainPhoto'] = basename($files[0]);
            }
            
            $price =  $cart->is_discount ? $cart->discount_price : $cart->price;

            $totalPrice += $price * $cart->quantity;
        }
        
        return inertia('Carts/Index', [
            'carts' => $carts,
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function checkout()
    { 
        if (!auth()->user()->mainAddress) {
            return redirect()->route('addresses.index');
        }
        
        $addresses = Address::with('city', 'district')->where('user_id', auth()->user()->id)->get();
        
        $carts = Cart::query()
                ->join('shoe_variants', 'carts.shoe_variant_id', 'shoe_variants.id')
                ->join('colors', 'shoe_variants.color_id', 'colors.id')
                ->join('sizes', 'shoe_variants.size_id', 'sizes.id')
                ->join('shoes', 'shoe_variants.shoe_id', 'shoes.id')
                ->select('carts.id', 'shoes.name', 'shoes.code', 'shoes.price', 'shoes.discount', 'shoes.discount_price', 'shoes.is_discount', 'colors.name AS color', 'sizes.name AS size', 'shoe_variants.stock', 'shoe_variants.photo AS variantPhoto', 'carts.quantity')
                ->where('carts.user_id', auth()->user()->id)
                ->get();
        
        if ($carts->count() < 1) {
            return redirect()->route('carts.index');
        }

        $totalPrice = 0;
        
        foreach ($carts as $cart) {
            if (!$cart->variantPhoto) {
                $path = 'public/shoes/' . $cart->code . '/main/';
                $files = Storage::files($path);

                $cart['mainPhoto'] = basename($files[0]);
            }
            
            $price =  $cart->is_discount ? $cart->discount_price : $cart->price;

            $totalPrice += $price * $cart->quantity;
        }
        
        return inertia('Carts/Checkout', [
            'addresses' => $addresses,
            'mainAddress' => auth()->user()->mainAddress->load('city', 'district'),
            'carts' => $carts,
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shoe_id' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
            'quantity' => 'required',
        ]);

        $shoeVariant = ShoeVariant::where('shoe_id', $request->shoe_id)
                        ->where('color_id', $request->color_id)
                        ->where('size_id', $request->size_id)
                        ->first();

        $cart = Cart::where('user_id', auth()->user()->id)->get();

        $shoeVariantInCart = $cart->first(function ($cartItem) use ($shoeVariant) {
            return $cartItem->shoe_variant_id === $shoeVariant->id;
        });
        
        if($cart->count() > 0 && $shoeVariantInCart) {
            $quantity =  $shoeVariantInCart->quantity + $request->quantity;

            if ($quantity > $shoeVariant->stock) {
                
                return redirect()->back()->with('message', [
                    'type' => 'failed',
                    'detail' => 'Stok barang ini sisa ' . $shoeVariant->stock . ' dan kamu sudah punya ' . $shoeVariantInCart->quantity . ' di keranjangmu.'
                ]);
            }
            
            $shoeVariantInCart->update([
                'quantity' => $quantity
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->user()->id,
                'shoe_variant_id' => $shoeVariant->id,
                'quantity' => $request->quantity
            ]);
        }
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $cart->update([
            'quantity' => $request->quantity
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->back();
    }
}
