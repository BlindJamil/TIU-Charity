<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate; // Keep Gate for potential future permission checks
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log; // Added for logging

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

        $admins = Admin::with('roles')->paginate(10); // Eager load roles
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
        $roles = Role::all(); // Get all available roles
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
            'roles' => ['nullable', 'array'], // Roles are optional on creation
            'roles.*' => ['exists:admin_roles,id'], // Validate each role ID exists
        ]);

        try {
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Sync roles if provided
            if ($request->has('roles')) {
                $admin->roles()->sync($request->roles);
            }

            Log::info('Admin user created successfully.', ['admin_id' => $admin->id, 'email' => $admin->email]);

            return redirect()->route('admin.admins.index')->with('success', 'Admin user created successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to create admin user.', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Failed to create admin user. Please check logs.');
        }
    }


    /**
     * Show the form for editing the specified admin user.
     */
    public function editAdmin(Admin $admin) // Route model binding simplifies finding the admin
    {
         if (!auth('admin')->user()->isSuperAdmin()) {
             abort(403, 'Unauthorized action.');
         }

        // Prevent super admin from editing themselves via this form (optional safety)
         if ($admin->id === auth('admin')->id()) {
            // Optionally redirect to profile page or show a message
            // For now, let's allow editing but maybe prevent role changes
            // return redirect()->route('admin.admins.index')->with('warning', 'Cannot edit own account via admin management.');
         }

        $roles = Role::all();
        $admin->load('roles'); // Eager load roles for efficiency
        $assignedRoleIds = $admin->roles->pluck('id')->toArray(); // Get IDs of assigned roles

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
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], // Password is optional on update
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:admin_roles,id'],
        ]);

         try {
            $data = $request->only('name', 'email');
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $admin->update($data);

            // Prevent super admin from removing their own super_admin role accidentally
            $rolesToSync = $request->input('roles', []);
            if ($admin->id === auth('admin')->id()) {
                $superAdminRole = Role::where('name', 'super_admin')->first();
                 if ($superAdminRole && !in_array($superAdminRole->id, $rolesToSync)) {
                     // Don't allow removal of super_admin role from self
                      return back()->withInput()->with('error', 'Super admin cannot remove their own super admin role.');
                 }
            }

            // Sync roles
            $admin->roles()->sync($rolesToSync);

            Log::info('Admin user updated successfully.', ['admin_id' => $admin->id]);
            return redirect()->route('admin.admins.index')->with('success', 'Admin user updated successfully.');

        } catch (\Exception $e) {
             Log::error('Failed to update admin user.', ['admin_id' => $admin->id, 'error' => $e->getMessage()]);
             return back()->withInput()->with('error', 'Failed to update admin user. Please check logs.');
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

        // Prevent deleting the last super admin (optional safety)
        if ($admin->isSuperAdmin()) {
             $superAdminCount = Admin::whereHas('roles', function ($query) {
                 $query->where('name', 'super_admin');
             })->count();
             if ($superAdminCount <= 1) {
                 return redirect()->route('admin.admins.index')->with('error', 'Cannot delete the last super admin.');
             }
        }


        try {
            $adminEmail = $admin->email; // Get email before deleting
            $admin->delete();
            Log::info('Admin user deleted successfully.', ['email' => $adminEmail]);
            return redirect()->route('admin.admins.index')->with('success', 'Admin user deleted successfully.');
        } catch (\Exception $e) {
             Log::error('Failed to delete admin user.', ['admin_id' => $admin->id, 'error' => $e->getMessage()]);
             return back()->with('error', 'Failed to delete admin user. Please check logs.');
        }
    }

    /**
     * Display a listing of all users (not admins) with search.
     */
    public function indexUsers(Request $request)
    {
        if (!auth('admin')->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $query = \App\Models\User::query();
        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ILIKE', "%$search%")
                  ->orWhere('email', 'ILIKE', "%$search%")
                  ->orWhere('phone', 'ILIKE', "%$search%")
                  ->orWhere('city', 'ILIKE', "%$search%")
                  ->orWhere('student_id', 'ILIKE', "%$search%")
                  ->orWhere('department', 'ILIKE', "%$search%")
                ;
            });
        }
        $users = $query->orderByDesc('created_at')->paginate(15);

        // Add statistics and filter variables
        $totalUsers = \App\Models\User::count();
        $newUsersThisMonth = \App\Models\User::whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->count();
        $usersWithDonations = \App\Models\User::has('donations')->count();
        $usersWithVolunteerWork = \App\Models\User::has('volunteers')->count();
        $departments = \App\Models\User::whereNotNull('department')->distinct()->pluck('department')->filter()->sort();
        $cities = \App\Models\User::whereNotNull('city')->distinct()->pluck('city')->filter()->sort();
        $graduationYears = \App\Models\User::whereNotNull('graduation_year')->distinct()->pluck('graduation_year')->filter()->sort();

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
     * Show details for a single user (profile, donations, volunteer activities).
     */
    public function showUser($id)
    {
        if (!auth('admin')->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        $user = \App\Models\User::findOrFail($id);
        $donations = $user->donations()->latest()->get();
        $volunteers = $user->volunteers()->with('project')->latest()->get();

        // Calculate stats
        $totalDonated = $donations->sum('amount');
        $completedVolunteerProjects = $volunteers->where('status', 'approved')->count();
        $totalVolunteerHours = $completedVolunteerProjects * 8; // Assuming 8 hours per project

        return view('admin.users.show', compact(
            'user',
            'donations',
            'volunteers',
            'totalDonated',
            'completedVolunteerProjects',
            'totalVolunteerHours'
        ));
    }

    /**
     * Export all users as a CSV file (admin only).
     */
    public function exportUsers()
    {
        if (!auth('admin')->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $fileName = 'users_export_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        $columns = ['ID', 'Name', 'Email', 'Phone', 'City', 'Department', 'Graduation Year', 'Created At'];

        $callback = function() use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            \App\Models\User::chunk(200, function($users) use ($handle) {
                foreach ($users as $user) {
                    fputcsv($handle, [
                        $user->id,
                        $user->name,
                        $user->email,
                        $user->phone,
                        $user->city,
                        $user->department,
                        $user->graduation_year,
                        $user->created_at,
                    ]);
                }
            });
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}