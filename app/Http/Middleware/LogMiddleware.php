<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function MongoDB\BSON\toJSON;

class LogMiddleware
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
        Log::info([
            'url' => $request->url(),
            'params' => $request->all(),
            'headers' => $request->headers->all(),
        ]);
        return $next($request);
    }
}
