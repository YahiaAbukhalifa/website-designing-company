<?php

namespace App\Http\Controllers;

use App\Mail\ProjectRequestSubmission;
use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    // List all projects and show create form
    public function index()
    {
        $projects = DB::table('projects')->orderBy('created_at', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    // Store a new project
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project_category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('projects', 'public');

        DB::table('projects')->insert([
            'name' => $request->name,
            'project_category' => $request->project_category,
            'image' => $imagePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.projects')->with('success', 'Project created successfully!');
    }

    // Show edit form for a project
    public function edit($id)
    {
        $project = DB::table('projects')->where('id', $id)->first();
        if (!$project) {
            return redirect()->route('admin.projects')->with('error', 'Project not found.');
        }
        return view('admin.projects.edit', compact('project'));
    }

    // Update a project
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project_category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $project = DB::table('projects')->where('id', $id)->first();
        if (!$project) {
            return redirect()->route('admin.projects')->with('error', 'Project not found.');
        }

        $data = [
            'name' => $request->name,
            'project_category' => $request->project_category,
            'updated_at' => now(),
        ];

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($project->image);
            // Store new image
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        DB::table('projects')->where('id', $id)->update($data);

        return redirect()->route('admin.projects')->with('success', 'Project updated successfully!');
    }

    // Delete a project
    public function destroy($id)
    {
        $project = DB::table('projects')->where('id', $id)->first();
        if (!$project) {
            return redirect()->route('admin.projects')->with('error', 'Project not found.');
        }

        // Delete image from storage
        Storage::disk('public')->delete($project->image);
        DB::table('projects')->where('id', $id)->delete();

        return redirect()->route('admin.projects')->with('success', 'Project deleted successfully!');
    }

    // Show project requests list
    public function projectRequests()
    {
        $projectRequests = ProjectRequest::all();
        return view('admin.project-requests', compact('projectRequests'));
    }

}