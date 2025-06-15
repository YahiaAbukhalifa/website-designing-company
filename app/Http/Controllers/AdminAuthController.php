<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = DB::table('admins')->where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    public function dashboard()
    {
        // Default period: today
        $period = $_GET['period'] ?? 'today';
        $timezone = 'Africa/Cairo';

        // Initialize dates with timezone
        $startDate = now()->setTimezone($timezone)->startOfDay();
        $endDate = now()->setTimezone($timezone)->endOfDay();

        // Adjust dates based on period
        try {
            switch ($period) {
                case 'last_7_days':
                    $startDate = now()->setTimezone($timezone)->subDays(7)->startOfDay();
                    $endDate = now()->setTimezone($timezone)->endOfDay();
                    break;
                case 'last_30_days':
                    $startDate = now()->setTimezone($timezone)->subDays(30)->startOfDay();
                    $endDate = now()->setTimezone($timezone)->endOfDay();
                    break;
                case 'custom':
                    $startDate = Carbon::parse($_GET['start_date'] ?? now()->startOfDay(), $timezone)->startOfDay();
                    $endDate = Carbon::parse($_GET['end_date'] ?? now()->endOfDay(), $timezone)->endOfDay();
                    if ($endDate < $startDate) {
                        $endDate = $startDate->copy()->endOfDay();
                    }
                    break;
                default: // today
                    $startDate = now()->setTimezone($timezone)->startOfDay();
                    $endDate = now()->setTimezone($timezone)->endOfDay();
            }
        } catch (\Exception $e) {
            Log::error('Date parsing error', ['error' => $e->getMessage(), 'period' => $period, 'start_date' => $_GET['start_date'] ?? null, 'end_date' => $_GET['end_date'] ?? null]);
            $startDate = now()->setTimezone($timezone)->startOfDay();
            $endDate = now()->setTimezone($timezone)->endOfDay();
        }

        // Admin dashboard analytics
        $adminViews = DB::table('admin_page_views')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('COUNT(*) as total_views, COUNT(DISTINCT ip_address) as unique_visitors')
            ->first();

        // Public pages analytics
        $publicViews = DB::table('page_views')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select('url')
            ->selectRaw('COUNT(*) as total_views, COUNT(DISTINCT ip_address) as unique_visitors')
            ->groupBy('url')
            ->get();

        // Log public views for debugging
        Log::info('Public views query', [
            'start_date' => $startDate->toDateTimeString(),
            'end_date' => $endDate->toDateTimeString(),
            'results' => $publicViews->toArray(),
        ]);

        // Get second latest admin visit (excluding current session)
        $currentSessionId = session()->getId();
        $adminName = session('admin_name', 'unknown');
        $lastVisit = DB::table('admin_page_views')
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(1)
            ->value('created_at');

        // Fetch new project requests since last visit
        $newProjects = $lastVisit
            ? DB::table('project_requests')
                ->where('created_at', '>', $lastVisit)
                ->select('id', 'full_name', 'email', 'project_category', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get()
            : collect([]);

        // Fetch new contact us requests since last visit
        $newContacts = $lastVisit
            ? DB::table('contact_us')
                ->where('created_at', '>', $lastVisit)
                ->select('id', 'name', 'email', 'message', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get()
            : collect([]);

        return view('admin.dashboard', compact('adminViews', 'publicViews', 'period', 'startDate', 'endDate', 'newProjects', 'newContacts', 'lastVisit'));
    }

    public function logout()
    {
        Session::forget(['admin_id', 'admin_name', 'admin_role']);
        return redirect()->route('admin.login');
    }
}