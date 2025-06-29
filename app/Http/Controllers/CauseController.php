<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cause;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CauseController extends Controller
{
    // Show all causes (Admin)
    public function index(Request $request)
    {
        $query = Cause::query();
        $department = $request->input('department');
        if ($department) {
            $query->where('department', 'ILIKE', "%$department%");
        }
        $causes = $query->get();
        $departments = Cause::distinct()
            ->whereNotNull('department')
            ->where('department', '!=', '')
            ->pluck('department')
            ->sort()
            ->values();
        return view('admin.causes.index', compact('causes', 'departments', 'department'));
    }

    // Show all causes (User)
    public function publicIndex()
    {
        $generalCauses = Cause::where('is_recent', false)->get();
        $recentCauses = Cause::where('is_recent', true)->get();
        return view('cause', compact('generalCauses', 'recentCauses'));
    }

    // Show create form
    public function create()
    {
        return view('admin.causes.create');
    }

    // Store new cause
    public function store(Request $request)
    {
        if (!auth('admin')->user()->hasPermission('manage_campaigns')) {
            abort(403, 'Unauthorized action. You can only view causes.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
            'cause_type' => 'required|in:general,recent',
            'receipt_expiry_days' => 'required|integer|min:1|max:90',
            'department' => 'nullable|string|max:255',
        ]);
        $goal = (float) $request->input('goal');
        $imagePath = $request->file('image')->store('causes', 'public');
        $isRecent = $request->input('cause_type') === 'recent';
        $isUrgent = $isRecent && $request->has('is_urgent');
        DB::table('causes')->insert([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'goal' => $goal,
            'raised' => 0,
            'image' => $imagePath,
            'department' => $request->input('department'),
            'receipt_expiry_days' => $request->input('receipt_expiry_days'),
            'is_recent' => $isRecent,
            'is_urgent' => $isUrgent,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $causeType = $isRecent ? 'recent' : 'general';
        return redirect()->route('admin.causes.index')->with('success', ucfirst($causeType) . ' cause created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $cause = Cause::findOrFail($id);
        return view('admin.causes.edit', compact('cause'));
    }

    // Update cause
    public function update(Request $request, $id)
    {
        if (!auth('admin')->user()->hasPermission('manage_campaigns')) {
            abort(403, 'Unauthorized action. You can only view causes.');
        }
        $cause = Cause::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'cause_type' => 'required|in:general,recent',
            'receipt_expiry_days' => 'required|integer|min:1|max:90',
            'department' => 'nullable|string|max:255',
        ]);
        if ($request->hasFile('image')) {
            Storage::delete('public/' . $cause->image);
            $cause->image = $request->file('image')->store('causes', 'public');
        }
        $isRecent = $request->input('cause_type') === 'recent';
        $isUrgent = $isRecent && $request->has('is_urgent');
        $cause->update([
            'title' => $request->title,
            'description' => $request->description,
            'goal' => $request->goal,
            'department' => $request->department,
            'receipt_expiry_days' => $request->receipt_expiry_days,
            'is_recent' => $isRecent,
            'is_urgent' => $isUrgent
        ]);
        $causeType = $isRecent ? 'recent' : 'general';
        return redirect()->route('admin.causes.index')->with('success', ucfirst($causeType) . ' cause updated successfully.');
    }

    // Delete a cause
    public function destroy($id)
    {
        if (!auth('admin')->user()->hasPermission('manage_campaigns')) {
            abort(403, 'Unauthorized action. You can only view causes.');
        }
        $cause = Cause::findOrFail($id);
        Storage::delete('public/' . $cause->image);
        $cause->delete();
        return redirect()->route('admin.causes.index')->with('success', 'Cause deleted successfully.');
    }
}