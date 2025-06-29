<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\VolunteerStatusMail;

class VolunteeringController extends Controller
{
    /**
     * Display the volunteering page
     */
    public function index()
    {
        // Get all active projects instead of just the latest one
        $projects = Project::latest()->get();
        
        // Initialize volunteer data
        $volunteerData = [];
        $hasVolunteeredForAny = false;
        
        // Process each project for volunteer data
        foreach ($projects as $project) {
            $volunteerCount = Volunteer::where('project_id', $project->id)->count();
            
            $hasVolunteered = false;
            $volunteerStatus = null;
            
            if (Auth::check()) {
                $volunteer = Volunteer::where('user_id', Auth::id())
                    ->where('project_id', $project->id)
                    ->first();
                    
                if ($volunteer) {
                    $hasVolunteered = true;
                    $hasVolunteeredForAny = true;
                    $volunteerStatus = $volunteer->status;
                }
            }
            
            $volunteerData[$project->id] = [
                'count' => $volunteerCount,
                'hasVolunteered' => $hasVolunteered,
                'status' => $volunteerStatus
            ];
        }
        
        return view('volunteer', compact('projects', 'volunteerData', 'hasVolunteeredForAny'));
    }
    
    /**
     * Store a new volunteer application
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'message' => 'nullable|string|max:500',
        ]);
        
        // Check if user already volunteered for this project
        $exists = Volunteer::where('user_id', Auth::id())
            ->where('project_id', $request->project_id)
            ->exists();
            
        if ($exists) {
            return redirect()->route('volunteer')
                ->with('error', 'You have already volunteered for this project.');
        }
        
        // Create new volunteer record
        Volunteer::create([
            'user_id' => Auth::id(),
            'project_id' => $request->project_id,
            'message' => $request->message,
            'status' => 'pending',
        ]);
        
        return redirect()->route('volunteer')
            ->with('success', 'Thank you for volunteering! Your application is pending approval.');
    }
    
    /**
     * Display a listing of projects (Admin)
     */
    public function adminIndex(Request $request)
    {
        $query = Project::with('volunteers')->latest();
        $department = $request->input('department');
        if ($department) {
            $query->where('department', 'ILIKE', "%$department%");
        }
        $projects = $query->get();
        $departments = Project::distinct()
            ->whereNotNull('department')
            ->where('department', '!=', '')
            ->pluck('department')
            ->sort()
            ->values();
        return view('admin.projects.index', compact('projects', 'departments', 'department'));
    }
    
    /**
     * Show the form for creating a new project (Admin)
     */
    public function create()
    {
        return view('admin.projects.create');
    }
    
    /**
     * Store a newly created project (Admin)
     */
    public function storeProject(Request $request)
    {
        // Check if user has permission to manage volunteers (not just view)
        if (!auth('admin')->user()->hasPermission('manage_volunteers')) {
            abort(403, 'Unauthorized action. You can only view volunteer projects.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'volunteers_needed' => 'required|integer|min:1',
            'department' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->except('image');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                $path = $request->file('image')->store('projects', 'public');
                $data['image'] = $path;
                \Log::info('Image uploaded successfully. Path: ' . $path);
            } catch (\Exception $e) {
                \Log::error('Image upload failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to upload image: ' . $e->getMessage());
            }
        }
        
        $project = Project::create($data);
        
        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }
    
    /**
     * Show the form for editing a project (Admin)
     */
    public function edit($id)
    {
        $project = Project::with('volunteers.user')->findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }
    
    /**
     * Update the specified project (Admin)
     */
    public function update(Request $request, $id)
    {
        // Check if user has permission to manage volunteers (not just view)
        if (!auth('admin')->user()->hasPermission('manage_volunteers')) {
            abort(403, 'Unauthorized action. You can only view volunteer projects.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'volunteers_needed' => 'required|integer|min:1',
            'department' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $project = Project::findOrFail($id);
        $data = $request->except('image');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            
            $data['image'] = $request->file('image')->store('projects', 'public');
        }
        
        $project->update($data);
        
        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }
    
    /**
     * Remove the specified project (Admin)
     */
    public function destroy($id)
    {
        // Check if user has permission to manage volunteers (not just view)
        if (!auth('admin')->user()->hasPermission('manage_volunteers')) {
            abort(403, 'Unauthorized action. You can only view volunteer projects.');
        }
        
        $project = Project::findOrFail($id);
        
        // Delete project image if exists
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        
        $project->delete();
        
        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
    
    /**
     * Approve a volunteer application (Admin)
     */
    public function approveVolunteer($id)
    {
        // Check if user has permission to manage volunteers (not just view)
        if (!auth('admin')->user()->hasPermission('manage_volunteers')) {
            return back()->with('error', 'Unauthorized action. You can only view volunteer applications.');
        }
        
        $volunteer = Volunteer::with('user')->findOrFail($id);
        $project = Project::findOrFail($volunteer->project_id);
        $volunteer->update(['status' => 'approved']);
        
        // Send email notification to volunteer
        try {
            if ($volunteer->user && $volunteer->user->email) {
                Mail::to($volunteer->user->email)
                    ->send(new VolunteerStatusMail($volunteer, $project, 'approved'));
            }
        } catch (\Exception $e) {
            // Log the error but don't stop the process
            \Illuminate\Support\Facades\Log::error('Failed to send volunteer status email: ' . $e->getMessage());
        }
        
        return back()->with('success', 'Volunteer application approved.');
    }
    
    /**
     * Reject a volunteer application (Admin)
     */
    public function rejectVolunteer($id)
    {
        // Check if user has permission to manage volunteers (not just view)
        if (!auth('admin')->user()->hasPermission('manage_volunteers')) {
            return back()->with('error', 'Unauthorized action. You can only view volunteer applications.');
        }
        
        $volunteer = Volunteer::with('user')->findOrFail($id);
        $project = Project::findOrFail($volunteer->project_id);
        $volunteer->update(['status' => 'rejected']);
        
        // Send email notification to volunteer
        try {
            if ($volunteer->user && $volunteer->user->email) {
                Mail::to($volunteer->user->email)
                    ->send(new VolunteerStatusMail($volunteer, $project, 'rejected'));
            }
        } catch (\Exception $e) {
            // Log the error but don't stop the process
            \Illuminate\Support\Facades\Log::error('Failed to send volunteer status email: ' . $e->getMessage());
        }
        
        return back()->with('success', 'Volunteer application rejected.');
    }
    
    /**
     * Reset a volunteer application status to pending (Admin)
     */
    public function resetVolunteer($id)
    {
        // Check if user has permission to manage volunteers (not just view)
        if (!auth('admin')->user()->hasPermission('manage_volunteers')) {
            return back()->with('error', 'Unauthorized action. You can only view volunteer applications.');
        }
        
        $volunteer = Volunteer::with('user')->findOrFail($id);
        $project = Project::findOrFail($volunteer->project_id);
        $volunteer->update(['status' => 'pending']);
        
        // Send email notification to volunteer
        try {
            if ($volunteer->user && $volunteer->user->email) {
                Mail::to($volunteer->user->email)
                    ->send(new VolunteerStatusMail($volunteer, $project, 'pending'));
            }
        } catch (\Exception $e) {
            // Log the error but don't stop the process
            \Illuminate\Support\Facades\Log::error('Failed to send volunteer status email: ' . $e->getMessage());
        }
        
        return back()->with('success', 'Volunteer application reset to pending.');
    }
}