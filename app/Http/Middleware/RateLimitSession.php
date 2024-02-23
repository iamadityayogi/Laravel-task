<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class RateLimitSession
{
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        $key = 'session_ip';
        if (Cache::has($key)) {
            $activeIp = Cache::get($key);
            if ($activeIp !== $ip) {
                return redirect()->back()->with('error', 'Another session is already in progress. Please try again later.');
            }
        }
        Cache::put($key, $ip, now()->addMinutes(60));
        return $next($request);
    }
}
