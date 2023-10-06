<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class DBTransaction
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        DB::beginTransaction();

        $response = $next($request);

        if (property_exists($response, 'exception')) {
            $response->exception instanceof Throwable ? DB::rollBack() : DB::commit();
        }

        return $response;
    }
}
