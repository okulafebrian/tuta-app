<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {        
        $quantity = null;

        if (auth()->check() && auth()->user()->role_id == 1) {
            $quantity = Cart::where('user_id', auth()->user()->id)->sum('quantity');
        }
        
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user() ? $request->user()->load('role', 'mainAddress') : null
            ],
            'flash' => [
                'message' => session('message'),
            ],
            'categories' => Category::all(),
            'provinces' => Province::all(),
            'quantity' => $quantity,
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
