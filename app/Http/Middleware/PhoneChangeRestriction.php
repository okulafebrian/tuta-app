<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class PhoneChangeRestriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $redirectToRoute = null): Response
    {
        $phoneLastUpdateDate = $request->user()->phone_last_update_date;
        $now = Carbon::now();

        if ($phoneLastUpdateDate->diffInMonths($now) < 2) {
            if ($request->expectsJson()) {
                return abort(403, 'Perubahan nomor hanya bisa dilakukan dalam 2 bulan sekali.');
            }
        }

        return $next($request);
    }
}
