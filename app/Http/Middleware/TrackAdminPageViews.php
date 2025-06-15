<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TrackAdminPageViews
{
    public function handle(Request $request, Closure $next)
    {
        // Get admin name from session
        $adminName = Session::get('admin_name', 'unknown');

        // Get client IP address
        $ipAddress = $request->ip();

        // Get session ID
        $sessionId = $request->session()->getId();

            DB::table('admin_page_views')->insert([
                'admin_name' => $adminName,
                'ip_address' => $ipAddress,
                'session_id' => $sessionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        return $next($request);
    }
}