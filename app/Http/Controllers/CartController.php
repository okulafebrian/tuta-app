<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressResource;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\ProductVariant;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['user.auth', 'verified.phone']);
    }

    public function index()
    {                
        $carts = auth()->user()->carts;

        return inertia('Carts/Index', [
            'carts' => CartResource::collection($carts),
            'totalPrice' => $this->calculateTotalPrice($carts)
        ]);
    }

    public function checkout()
    { 
        $carts = auth()->user()->carts;

        if ($carts->count() < 1) {
            return redirect()->route('carts.index');
        }

        $mainAddress = auth()->user()->mainAddress;

        return inertia('Carts/Checkout', [
            'carts' => CartResource::collection($carts),
            'addresses' => AddressResource::collection(auth()->user()->addresses->sortByDesc('is_main')),
            'mainAddress' => $mainAddress ? AddressResource::make($mainAddress): null,
            'totalPrice' => $this->calculateTotalPrice($carts)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
            'quantity' => 'required',
        ]);

        $productVariant = ProductVariant::where('product_id', $request->product_id)
                        ->where('color_id', $request->color_id)
                        ->where('size_id', $request->size_id)
                        ->first();

        $carts = Cart::where('user_id', auth()->user()->id)->get();

        $productVariantInCart = $carts->first(function ($cart) use ($productVariant) {
            return $cart->product_variant_id === $productVariant->id;
        });

        if($productVariantInCart) {
            $quantity =  $productVariantInCart->quantity + $request->quantity;

            if ($quantity > $productVariant->stock) {
                return back()->with(['error' => 'Stok barang ini sisa ' . $productVariant->stock . ' dan kamu sudah punya ' . $productVariantInCart->quantity . ' di keranjangmu.']);
            }
            
            $productVariantInCart->update([
                'quantity' => $quantity
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->user()->id,
                'product_variant_id' => $productVariant->id,
                'quantity' => $request->quantity
            ]);
        }

        return back()->with(['success' => 'Produk berhasil ditambahkan ke keranjang.']);
    }

    public function update(Request $request, Cart $cart)
    {
        $cart->update([
            'quantity' => $request->quantity
        ]);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return back()->with(['success' => 'Produk berhasil dihapus dari keranjang.']);
    }

    private function calculateTotalPrice($carts)
    {
        $totalPrice = 0;

        foreach ($carts as $cart) {
            $product = $cart->productVariant->product;
            
            $price = $product->is_discount ? $product->discount_price : $product->price;

            $subTotal = $cart->quantity * $price;

            $totalPrice += $subTotal;
        }

        return $totalPrice;
    }
}
