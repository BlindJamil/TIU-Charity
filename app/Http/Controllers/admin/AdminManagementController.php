<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use App\Models\Donation;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminManagementController extends Controller
{
    /**
     * Display a listing of the admin users.
     */
    public function indexAdmins()
    {
        // Ensure only super_admin can manage admins
        if (!auth('admin')->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $admins = Admin::with('roles')->paginate(10);
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new admin user.
     */
    public function createAdmin()
    {
        if (!auth('admin')->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        $roles = Role::all();
        return view('admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created admin user in storage.
     */
    public function storeAdmin(Request $request)
    {
        if (!auth('admin')->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:admin_users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:admin_roles,id'],
        ]);

        try {
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->has('roles')) {
                $admin->roles()->sync($request->roles);
            }

            Log::info('Admin user created successfully.', ['admin_id' => $admin->id, 'email' => $admin->email]);

            return redirect()->route('admin.admins.index')->with('success', 'Admin user created successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to create admin user.', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Failed to create admin user. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified admin user.
     */
    public function editAdmin(Admin $admin)
    {
         if (!auth('admin')->user()->isSuperAdmin()) {
             abort(403, 'Unauthorized action.');
         }

        $roles = Role::all();
        $admin->load('roles');
        $assignedRoleIds = $admin->roles->pluck('id')->toArray();

        return view('admin.admins.edit', compact('admin', 'roles', 'assignedRoleIds'));
    }

    /**
     * Update the specified admin user in storage.
     */
    public function updateAdmin(Request $request, Admin $admin)
    {
        if (!auth('admin')->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('admin_users')->ignore($admin->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:admin_roles,id'],
        ]);

         try {
            $data = $request->only('name', 'email');
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $admin->update($data);

            // Prevent super admin from removing their own super_admin role
            $rolesToSync = $request->input('roles', []);
            if ($admin->id === auth('admin')->id()) {
                $superAdminRole = Role::where('name', 'super_admin')->first();
                 if ($superAdminRole && !in_array($superAdminRole->id, $rolesToSync)) {
                      return back()->withInput()->with('error', 'Super admin cannot remove their own super admin role.');
                 }
            }

            $admin->roles()->sync($rolesToSync);

            Log::info('Admin user updated successfully.', ['admin_id' => $admin->id]);
            return redirect()->route('admin.admins.index')->with('success', 'Admin user updated successfully.');

        } catch (\Exception $e) {
             Log::error('Failed to update admin user.', ['admin_id' => $admin->id, 'error' => $e->getMessage()]);
             return back()->withInput()->with('error', 'Failed to update admin user. Please try again.');
        }
    }

    /**
     * Remove the specified admin user from storage.
     */
    public function destroyAdmin(Admin $admin)
    {
        if (!auth('admin')->user()->isSuperAdmin()) {
             abort(403, 'Unauthorized action.');
        }

        // Prevent deleting self
        if ($admin->id === auth('admin')->id()) {
            return redirect()->route('admin.admins.index')->with('error', 'You cannot delete your own account.');
        }

        // Prevent deleting the last super admin
        if ($admin->isSuperAdmin()) {
             $superAdminCount = Admin::whereHas('roles', function ($query) {
                 $query->where('name', 'super_admin');
             })->count();
             if ($superAdminCount <= 1) {
                 return redirect()->route('admin.admins.index')->with('error', 'Cannot delete the last super admin.');
             }
        }

        try {
            $adminEmail = $admin->email;
            $admin->delete();
            Log::info('Admin user deleted successfully.', ['email' => $adminEmail]);
            return redirect()->route('admin.admins.index')->with('success', 'Admin user deleted successfully.');
        } catch (\Exception $e) {
             Log::error('Failed to delete admin user.', ['admin_id' => $admin->id, 'error' => $e->getMessage()]);
             return back()->with('error', 'Failed to delete admin user. Please try again.');
        }
    }

    /**
     * Display a listing of all users with improved search and filtering.
     */
    public function indexUsers(Request $request)
    {
        // Default values to prevent undefined variable errors
        $totalUsers = 0;
        $newUsersThisMonth = 0;
        $usersWithDonations = 0;
        $usersWithVolunteerWork = 0;
        $departments = collect();
        $cities = collect();
        $graduationYears = collect();
        $users = collect();
        $search = $request->input('search', '');
        
        \Log::debug('indexUsers method called in AdminManagementController');

        // Check permissions
        if (!auth('admin')->user()->hasPermission('manage_admins') && !auth('admin')->user()->hasPermission('view_users')) {
            // Always return the view with the variables, even if unauthorized
            return view('admin.users.index', compact(
                'users', 
                'search', 
                'departments', 
                'cities', 
                'graduationYears',
                'totalUsers',
                'newUsersThisMonth',
                'usersWithDonations',
                'usersWithVolunteerWork'
            ));
        }

        $query = \App\Models\User::query();
        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhere('phone', 'LIKE', "%$search%")
                  ->orWhere('city', 'LIKE', "%$search%")
                  ->orWhere('student_id', 'LIKE', "%$search%")
                  ->orWhere('department', 'LIKE', "%$search%")
                ;
            });
        }
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }
        if ($request->filled('graduation_year')) {
            $query->where('graduation_year', $request->graduation_year);
        }
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        $users = $query->withCount(['donations', 'volunteers'])
                      ->orderByDesc('created_at')
                      ->paginate(15);

        // Get filter options
        $departments = \App\Models\User::whereNotNull('department')->distinct()->pluck('department')->filter()->sort();
        $cities = \App\Models\User::whereNotNull('city')->distinct()->pluck('city')->filter()->sort();
        $graduationYears = \App\Models\User::whereNotNull('graduation_year')->distinct()->pluck('graduation_year')->filter()->sort();

        // Get statistics
        $totalUsers = \App\Models\User::count();
        $newUsersThisMonth = \App\Models\User::whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->count();
        $usersWithDonations = \App\Models\User::has('donations')->count();
        $usersWithVolunteerWork = \App\Models\User::has('volunteers')->count();

        return view('admin.users.index', compact(
            'users', 
            'search', 
            'departments', 
            'cities', 
            'graduationYears',
            'totalUsers',
            'newUsersThisMonth',
            'usersWithDonations',
            'usersWithVolunteerWork'
        ));
    }

    /**
     * Show details for a single user with enhanced information.
     */
    public function showUser($id)
    {
        // Check permissions
        if (!auth('admin')->user()->hasPermission('manage_admins') && !auth('admin')->user()->hasPermission('view_users')) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($id);
        
        // Get user's donations with cause information
        $donations = $user->donations()
                         ->with('cause')
                         ->latest()
                         ->get();

        // Get user's volunteer activities with project information
        $volunteers = $user->volunteers()
                          ->with('project')
                          ->latest()
                          ->get();

        // Calculate user statistics
        $totalDonated = $donations->sum('amount');
        $totalVolunteerHours = $volunteers->where('status', 'approved')->count() * 8; // Assuming 8 hours per volunteer activity
        $completedVolunteerProjects = $volunteers->where('status', 'approved')->count();

        return view('admin.users.show', compact(
            'user', 
            'donations', 
            'volunteers',
            'totalDonated',
            'totalVolunteerHours',
            'completedVolunteerProjects'
        ));
    }

    /**
     * Export users data to CSV
     */
    public function exportUsers(Request $request)
    {
        if (!auth('admin')->user()->hasPermission('manage_admins')) {
            abort(403, 'Unauthorized action.');
        }

        $query = User::query();
        
        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhere('phone', 'LIKE', "%$search%");
            });
        }

        $users = $query->with(['donations', 'volunteers'])->get();

        $filename = 'users_export_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'Name', 'Email', 'Phone', 'City', 'Student ID', 'Department', 
                'Graduation Year', 'Total Donations', 'Donation Amount', 
                'Volunteer Activities', 'Registration Date'
            ]);

            // Add data rows
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->name,
                    $user->email,
                    $user->phone,
                    $user->city,
                    $user->student_id,
                    $user->department,
                    $user->graduation_year,
                    $user->donations->count(),
                    '$' . number_format($user->donations->sum('amount'), 2),
                    $user->volunteers->count(),
                    $user->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}