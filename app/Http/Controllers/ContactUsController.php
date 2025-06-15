<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSubmission;

class ContactUsController extends Controller
{
    // Show contact submissions and email receiver form
    public function showList()
    {
        $contacts = DB::table('contact_us')->orderBy('created_at', 'desc')->get();
        $receivers = DB::table('email_receivers')->orderBy('created_at', 'desc')->get();
        return view('admin.contact-us', compact('contacts', 'receivers'));
    }

    // Handle email receiver form submission
    public function storeReceiver(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:email_receivers,email',
        ]);

        DB::table('email_receivers')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.contact-us')->with('success', 'Email receiver added successfully!');
    }

    public function deleteContact($id)
    {
        // Delete contact us entry
        $deleted = DB::table('email_receivers')->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->route('admin.dashboard', request()->query())->with('success', 'Contact request deleted successfully.');
        }

        return redirect()->route('admin.dashboard', request()->query())->with('error', 'Failed to delete contact request.');
    }
}