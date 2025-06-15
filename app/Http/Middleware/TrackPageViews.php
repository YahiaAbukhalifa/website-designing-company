<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TrackPageViews
{
    public function handle(Request $request, Closure $next)
    {
        // Get the request URL (path only, e.g., /, /portfolio, /order)
        $url = $request->path() === '/' ? 'home' : $request->path();

        // Get the client IP address
        $ipAddress = $request->ip();

        // Get or generate a session ID
        $sessionId = $request->session()->getId();

            DB::table('page_views')->insert([
                'url' => $url,
                'ip_address' => $ipAddress,
                'session_id' => $sessionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        return $next($request);
    }
}