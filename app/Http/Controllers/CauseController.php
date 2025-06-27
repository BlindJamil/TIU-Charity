<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cause;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CauseController extends Controller
{
    // ✅ Show all causes (Admin)
    public function index()
    {
        $causes = Cause::all();
        return view('admin.causes.index', compact('causes'));
    }

    // ✅ Show all causes (User)
    public function publicIndex()
    {
        // Explicit filtering to separate general and recent causes
        $generalCauses = Cause::where('is_recent', false)->get();
        $recentCauses = Cause::where('is_recent', true)->get();
        
        return view('cause', compact('generalCauses', 'recentCauses'));
    }

    // ✅ Show create form
    public function create()
    {
        return view('admin.causes.create');
    }

    // ✅ Store new cause
    public function store(Request $request)
    {
        // Check if user has permission to manage causes (not just view)
        if (!auth('admin')->user()->hasPermission('manage_causes')) {
            abort(403, 'Unauthorized action. You can only view causes.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
            'cause_type' => 'required|in:general,recent',
            'receipt_expiry_days' => 'required|integer|min:1|max:90',
        ]);

        // 🛠️ Explicitly assign goal and convert to a number
        $goal = (float) $request->input('goal');

        // Save image
        $imagePath = $request->file('image')->store('causes', 'public');

        // Determine if this is a recent or general cause
        $isRecent = $request->input('cause_type') === 'recent';
        
        // Process urgent checkbox value (only applies to recent causes)
        $isUrgent = $isRecent && $request->has('is_urgent');

        // Insert into DB
        DB::table('causes')->insert([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'goal' => $goal,
            'raised' => 0,
            'image' => $imagePath,
            'receipt_expiry_days' => $request->input('receipt_expiry_days'),
            'is_recent' => $isRecent,
            'is_urgent' => $isUrgent,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $causeType = $isRecent ? 'recent' : 'general';
        return redirect()->route('admin.causes.index')->with('success', ucfirst($causeType) . ' cause created successfully!');
    }
    
    // ✅ Show edit form
    public function edit($id)
    {
        $cause = Cause::findOrFail($id); // Ensures cause exists
        return view('admin.causes.edit', compact('cause'));
    }

    // ✅ Update cause
    public function update(Request $request, $id)
    {
        // Check if user has permission to manage causes (not just view)
        if (!auth('admin')->user()->hasPermission('manage_causes')) {
            abort(403, 'Unauthorized action. You can only view causes.');
        }
        
        $cause = Cause::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480', // Made image optional on update
            'cause_type' => 'required|in:general,recent',
            'receipt_expiry_days' => 'required|integer|min:1|max:90',
        ]);

        // ✅ Delete old image if a new one is uploaded
        if ($request->hasFile('image')) {
            Storage::delete('public/' . $cause->image);
            $cause->image = $request->file('image')->store('causes', 'public');
        }

        // Determine if this is a recent or general cause
        $isRecent = $request->input('cause_type') === 'recent';
        
        // Process urgent checkbox value (only applies to recent causes)
        $isUrgent = $isRecent && $request->has('is_urgent');

        // ✅ Update the cause
        $cause->update([
            'title' => $request->title,
            'description' => $request->description,
            'goal' => $request->goal,
            'receipt_expiry_days' => $request->receipt_expiry_days,
            'is_recent' => $isRecent,
            'is_urgent' => $isUrgent
        ]);

        $causeType = $isRecent ? 'recent' : 'general';
        return redirect()->route('admin.causes.index')->with('success', ucfirst($causeType) . ' cause updated successfully.');
    }

    // ✅ Delete a cause
    public function destroy($id)
    {
        // Check if user has permission to manage causes (not just view)
        if (!auth('admin')->user()->hasPermission('manage_causes')) {
            abort(403, 'Unauthorized action. You can only view causes.');
        }
        
        $cause = Cause::findOrFail($id);

        // ✅ Delete the image from storage
        Storage::delete('public/' . $cause->image);

        $cause->delete();
        
        return redirect()->route('admin.causes.index')->with('success', 'Cause deleted successfully.');
    }
}