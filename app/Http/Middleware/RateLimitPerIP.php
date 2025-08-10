<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RateLimitPerIP
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->getClientIp();
        $key = "rate_limit:" . $ip;

        if (RateLimiter::tooManyAttempts($key, 20)) { // Max 10 requests per minute
            return response()->json(['error' => 'Too many requests. Try again later.'], 429);
        }

        RateLimiter::hit($key, 60); // 60 seconds window

        return $next($request);
    }
}

