<?php

namespace App\Http\Middleware;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserResource;
use App\Models\Cart;
use App\Models\Category;
use App\Models\District;
use App\Models\Order;
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
        $user = $request->user();

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user ? UserResource::make($user) : null
            ],
            'flash' => [
                'error' => session('error'),
                'success' => session('success'),
            ],
            'categories' => CategoryResource::collection(Category::all()),
            'cartQuantity' => $user ? $user->carts->sum('quantity') : 0,
            'orderQuantity' => $user && $user->role->id != 1 ? Order::where('status', Order::PAYMENT_SUCCESS)->count() : 0,
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
