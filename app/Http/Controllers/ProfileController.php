<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile dashboard
     */
    public function dashboard(Request $request): View
    {
        $user = $request->user();
        
        // Get summary data for the dashboard
        $totalDonated = $this->getUserTotalDonations($user);
        $donatedCausesCount = $this->getUserDonatedCausesCount($user);
        $volunteerProjectsCount = $this->getUserVolunteerProjectsCount($user);
        $achievements = $this->calculateAchievements($user, $totalDonated, $volunteerProjectsCount);
        
        // Get upcoming volunteer projects
        $upcomingProjects = $this->getUpcomingProjects($user);
        
        // Get notifications for the dropdown
        try {
            $notifications = $user->notifications()->latest()->take(5)->get();
        } catch (\Exception $e) {
            $notifications = collect();
        }
        
        return view('profile.dashboard', [
            'user' => $user,
            'totalDonated' => $totalDonated,
            'donatedCausesCount' => $donatedCausesCount,
            'volunteerProjectsCount' => $volunteerProjectsCount,
            'achievements' => $achievements,
            'upcomingProjects' => $upcomingProjects,
            'notifications' => $notifications,
            'activeTab' => 'dashboard'
        ]);
    }

    /**
     * Display the user's profile edit form
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        
        // Get notifications for the dropdown
        try {
            $notifications = $user->notifications()->latest()->take(5)->get();
        } catch (\Exception $e) {
            $notifications = collect();
        }
        
        return view('profile.edit', [
            'user' => $user,
            'notifications' => $notifications,
            'activeTab' => 'information'
        ]);
    }
    
    /**
     * Display the password change form
     */
    public function editPassword(Request $request): View
    {
        $user = $request->user();
        
        // Get notifications for the dropdown
        try {
            $notifications = $user->notifications()->latest()->take(5)->get();
        } catch (\Exception $e) {
            $notifications = collect();
        }
        
        return view('profile.password', [
            'user' => $user,
            'notifications' => $notifications,
            'activeTab' => 'password'
        ]);
    }
    
    /**
     * Display the user's donation history
     */
    public function donations(Request $request): View
    {
        $user = $request->user();
        
        // Get the user's donation history
        $donations = $this->getUserDonations($user);
        $totalDonated = $this->getUserTotalDonations($user);
        $donatedCauses = $this->getUserDonatedCauses($user);
        
        // Get notifications for the dropdown
        try {
            $notifications = $user->notifications()->latest()->take(5)->get();
        } catch (\Exception $e) {
            $notifications = collect();
        }
        
        return view('profile.donations', [
            'user' => $user,
            'donations' => $donations,
            'totalDonated' => $totalDonated,
            'donatedCauses' => $donatedCauses,
            'notifications' => $notifications,
            'activeTab' => 'donations'
        ]);
    }
    
    /**
     * Display the user's volunteer activity
     */
    public function volunteer(Request $request): View
    {
        $user = $request->user();
        
        // Get user's volunteer activities
        $volunteerActivities = $this->getUserVolunteerActivities($user);
        $volunteerProjectsCount = $this->getUserVolunteerProjectsCount($user);
        $upcomingProjects = $this->getUpcomingProjects($user);
        
        // Get notifications for the dropdown
        try {
            $notifications = $user->notifications()->latest()->take(5)->get();
        } catch (\Exception $e) {
            $notifications = collect();
        }
        
        return view('profile.volunteer', [
            'user' => $user,
            'volunteerActivities' => $volunteerActivities,
            'volunteerProjectsCount' => $volunteerProjectsCount,
            'upcomingProjects' => $upcomingProjects,
            'notifications' => $notifications,
            'activeTab' => 'volunteer'
        ]);
    }
    
    /**
     * Display the account deletion page
     */
    public function deleteAccount(Request $request): View
    {
        $user = $request->user();
        
        // Get notifications for the dropdown
        try {
            $notifications = $user->notifications()->latest()->take(5)->get();
        } catch (\Exception $e) {
            $notifications = collect();
        }
        
        return view('profile.delete', [
            'user' => $user,
            'notifications' => $notifications,
            'activeTab' => 'delete'
        ]);
    }
    
    /**
     * Update the user's profile image
     */
    public function updateProfileImage(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_image' => ['required', 'image', 'max:2048'], // 2MB max
        ]);
        
        $user = $request->user();
        
        // Delete old image if exists
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }
        
        // Store the new image
        $path = $request->file('profile_image')->store('profile-images', 'public');
        $user->profile_image = $path;
        $user->save();
        
        return Redirect::route('profile.dashboard')->with('status', 'Profile image updated successfully.');
    }
    
    /**
     * Remove the user's profile image
     */
    public function removeProfileImage(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        // Delete profile image if it exists
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }
        
        // Clear the profile_image field
        $user->profile_image = null;
        $user->save();
        
        return Redirect::route('profile.dashboard')->with('status', 'Profile image removed successfully.');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        
        // Delete profile image if it exists
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
    /**
     * Mark all notifications as read
     */
    public function markAllNotificationsAsRead(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        try {
            $user->unreadNotifications->markAsRead();
        } catch (\Exception $e) {
            // Silent fail if notifications table doesn't exist
        }
        
        return back();
    }
    
    /**
     * Helper method to get user's donations
     */
    private function getUserDonations($user)
    {
        try {
            return DB::table('donations')
                ->leftJoin('causes', 'donations.cause_id', '=', 'causes.id')
                ->where('donations.user_id', $user->id)
                ->select(
                    'donations.*',
                    'causes.title as cause_title'
                )
                ->orderBy('donations.created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    /**
     * Helper method to get user's total donations
     */
    private function getUserTotalDonations($user)
    {
        try {
            return DB::table('donations')
                ->where('user_id', $user->id)
                ->sum('amount');
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Helper method to get user's donated causes
     */
    private function getUserDonatedCauses($user)
    {
        try {
            return DB::table('donations')
                ->join('causes', 'donations.cause_id', '=', 'causes.id')
                ->where('donations.user_id', $user->id)
                ->select('causes.id', 'causes.title', 'causes.image')
                ->distinct()
                ->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    /**
     * Helper method to get count of user's donated causes
     */
    private function getUserDonatedCausesCount($user)
    {
        try {
            return DB::table('donations')
                ->join('causes', 'donations.cause_id', '=', 'causes.id')
                ->where('donations.user_id', $user->id)
                ->distinct('causes.id')
                ->count('causes.id');
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Helper method to get user's volunteer activities
     */
    private function getUserVolunteerActivities($user)
    {
        try {
            return DB::table('volunteers')
                ->join('projects', 'volunteers.project_id', '=', 'projects.id')
                ->where('volunteers.user_id', $user->id)
                ->select(
                    'volunteers.id',
                    'volunteers.status',
                    'volunteers.created_at',
                    'projects.title',
                    'projects.description',
                    'projects.image',
                    'projects.start_date',
                    'projects.end_date',
                    'projects.location'
                )
                ->orderBy('volunteers.created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    /**
     * Helper method to get count of user's volunteer projects
     */
    private function getUserVolunteerProjectsCount($user)
    {
        try {
            return DB::table('volunteers')
                ->where('user_id', $user->id)
                ->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Helper method to get upcoming volunteer projects
     */
    private function getUpcomingProjects($user)
    {
        try {
            return DB::table('volunteers')
                ->join('projects', 'volunteers.project_id', '=', 'projects.id')
                ->where('volunteers.user_id', $user->id)
                ->where('volunteers.status', 'approved')
                ->whereRaw('projects.start_date > NOW()')
                ->select(
                    'projects.title',
                    'projects.description',
                    'projects.start_date',
                    'projects.end_date',
                    'projects.location'
                )
                ->orderBy('projects.start_date', 'asc')
                ->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    /**
     * Calculate user's achievements based on activity.
     */
    private function calculateAchievements($user, $totalDonated, $volunteerProjectsCount)
    {
        $achievements = [];
        
        // Donor badges
        if ($totalDonated >= 1000) {
            $achievements[] = [
                'name' => 'Generous Donor',
                'description' => 'Donated $1,000 or more to causes',
                'icon' => 'money-bill-wave',
                'color' => 'gold'
            ];
        } elseif ($totalDonated >= 500) {
            $achievements[] = [
                'name' => 'Supportive Donor',
                'description' => 'Donated $500 or more to causes',
                'icon' => 'money-bill-wave',
                'color' => 'silver'
            ];
        } elseif ($totalDonated >= 100) {
            $achievements[] = [
                'name' => 'Kind Donor',
                'description' => 'Donated $100 or more to causes',
                'icon' => 'money-bill-wave', 
                'color' => 'bronze'
            ];
        }
        
        // Volunteer badges
        if ($volunteerProjectsCount >= 10) {
            $achievements[] = [
                'name' => 'Dedicated Volunteer',
                'description' => 'Volunteered for 10 or more projects',
                'icon' => 'hands-helping',
                'color' => 'gold'
            ];
        } elseif ($volunteerProjectsCount >= 5) {
            $achievements[] = [
                'name' => 'Regular Volunteer',
                'description' => 'Volunteered for 5 or more projects',
                'icon' => 'hands-helping',
                'color' => 'silver'
            ];
        } elseif ($volunteerProjectsCount >= 1) {
            $achievements[] = [
                'name' => 'New Volunteer',
                'description' => 'Volunteered for your first project',
                'icon' => 'hands-helping',
                'color' => 'bronze'
            ];
        }
        
        // Account tenure
        $accountAge = now()->diffInMonths($user->created_at);
        
        if ($accountAge >= 24) {
            $achievements[] = [
                'name' => 'Loyal Supporter',
                'description' => 'Member for 2+ years',
                'icon' => 'user-clock',
                'color' => 'gold'
            ];
        } elseif ($accountAge >= 12) {
            $achievements[] = [
                'name' => 'Committed Supporter',
                'description' => 'Member for 1+ year',
                'icon' => 'user-clock',
                'color' => 'silver'
            ];
        } elseif ($accountAge >= 6) {
            $achievements[] = [
                'name' => 'Regular Supporter',
                'description' => 'Member for 6+ months',
                'icon' => 'user-clock',
                'color' => 'bronze'
            ];
        }
        
        return $achievements;
    }
}