<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class CachingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Cache::store('memcached')->get($request->route()->uri())) {
            return Cache::store('memcached')->get($request->route()->uri());
        }
        $response = $next($request);
        if ($response->getStatusCode() === 200) {
            Cache::store('memcached')->Forever($request->route()->uri(), $response->getContent());

        }
        return $response;
    }
}
