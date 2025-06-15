<?php

namespace App\Http\Controllers;

use App\Mail\ProjectRequestSubmission;
use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactSubmission;

class FrontendController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        // Fetch latest 6 projects
        $projects = DB::table('projects')
            ->select('id', 'name', 'project_category', 'image')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Count projects per category
        $categoryCounts = DB::table('projects')
            ->select('project_category', DB::raw('COUNT(*) as count'))
            ->groupBy('project_category')
            ->pluck('count', 'project_category')
            ->toArray();
        return view('frontend.home', compact('projects', 'categoryCounts'));
    }

    /**
     * Display the portfolio page with optional category filter.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function portfolio(Request $request)
    {
        // Fetch all projects
        $projects = DB::table('projects')
            ->select('id', 'name', 'project_category', 'image')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('frontend.portfolio', compact('projects'));
    }

    /**
     * Display the order form.
     *
     * @return \Illuminate\View\View
     */
    public function order()
    {
        return view('frontend.order');
    }

    /**
     * Handle the order form submission.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function orderSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'project_status' => 'required|string|in:planning,design,construction,renovation',
            'land_area' => 'required|numeric|min:0',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'project_category' => 'required|string|in:residential,commercial,villa,apartment',
            'number_of_flats' => 'required|integer|min:0',
            'cellar_count' => 'required|integer|min:0',
            'floor_count' => 'nullable|integer|min:0',
            'ground_floor' => 'boolean',
            'first_round' => 'boolean',
            'upper_annex' => 'boolean',
            'drivers_room' => 'boolean',
            'swimming_pool' => 'boolean',
            'mens_diwaniya' => 'boolean',
            'womens_diwaniya' => 'boolean',
            'parking' => 'boolean',
            'multiple_floors' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $projectRequest = ProjectRequest::create([
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'project_status' => $request->project_status,
            'land_area' => $request->land_area,
            'city' => $request->city,
            'district' => $request->district,
            'project_category' => $request->project_category,
            'number_of_flats' => $request->number_of_flats,
            'cellar_count' => $request->cellar_count,
            'floor_count' => $request->multiple_floors ? $request->floor_count : null,
            'ground_floor' => $request->has('ground_floor'),
            'first_round' => $request->has('first_round'),
            'upper_annex' => $request->has('upper_annex'),
            'drivers_room' => $request->has('drivers_room'),
            'swimming_pool' => $request->has('swimming_pool'),
            'mens_diwaniya' => $request->has('mens_diwaniya'),
            'womens_diwaniya' => $request->has('womens_diwaniya'),
            'parking' => $request->has('parking'),
            'multiple_floors' => $request->has('multiple_floors'),
        ]);

        // Fetch email receivers
        $receivers = DB::table('email_receivers')->get();

        // Send email to each receiver
        if ($receivers->isEmpty()) {
            return redirect()->route('order')->with('success', 'Project request submitted successfully.');
        }

        foreach ($receivers as $receiver) {
            try {
                Mail::to($receiver->email)->send(new ProjectRequestSubmission($projectRequest));
            } catch (\Exception $e) {
                Log::error('Failed to send project request email to ' . $receiver->email . ': ' . $e->getMessage());
            }
        }

        return redirect()->route('order')->with('success', 'Project request submitted successfully and emails sent to receivers!');
    }

    /**
     * Handle the contact form submission.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Insert into contact_us table
        $contact = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('contact_us')->insert($contact);

        // Fetch email receivers
        $receivers = DB::table('email_receivers')->get();

        // Send email to each receiver
        if ($receivers->isEmpty()) {
            return redirect()->route('home')->with('success', 'Contact entry added successfully.');
        }

        foreach ($receivers as $receiver) {
            try {
                Mail::to($receiver->email)->send(new ContactSubmission((object) $contact));
            } catch (\Exception $e) {
                Log::error('Failed to send contact submission email to ' . $receiver->email . ': ' . $e->getMessage());
            }
        }

        return redirect()->route('home')->with('success', 'Contact entry added successfully!');
    }
}
