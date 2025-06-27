<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle an admin login request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate login data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Log::info('Admin login attempt', ['email' => $request->email]);
        
        // Clear any existing sessions to avoid conflicts
        Auth::guard('admin')->logout();
        Session::flush();
        
        // Approach 1: Try with Auth facade
        if (Auth::guard('admin')->attempt($credentials)) {
            Log::info('Admin login successful via guard attempt', [
                'admin_id' => Auth::guard('admin')->id(),
                'admin_email' => Auth::guard('admin')->user()->email
            ]);
            
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }
        
        // Approach 2: Try with direct model
        try {
            $admin = Admin::where('email', $request->email)->first();
            
            if ($admin && Hash::check($request->password, $admin->password)) {
                Log::info('Admin found with correct password', ['id' => $admin->id]);
                
                // Login directly with the admin model
                Auth::guard('admin')->login($admin);
                
                if (Auth::guard('admin')->check()) {
                    Log::info('Admin login successful via model login', [
                        'id' => Auth::guard('admin')->id()
                    ]);
                    
                    $request->session()->regenerate();
                    return redirect()->intended(route('admin.dashboard'));
                } else {
                    Log::error('Failed to login with model login method');
                }
            } else {
                Log::error('Admin not found or password incorrect');
            }
        } catch (\Exception $e) {
            Log::error('Exception during admin login: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
        }
        
        // Approach 3: Manual ID login
        try {
            $admin = DB::table('admin_users')->where('email', $request->email)->first();
            
            if ($admin && Hash::check($request->password, $admin->password)) {
                Log::info('Admin found via DB query', ['id' => $admin->id]);
                
                // Try logging in with ID
                Auth::guard('admin')->loginUsingId($admin->id);
                
                if (Auth::guard('admin')->check()) {
                    Log::info('Admin login successful via ID login', [
                        'id' => Auth::guard('admin')->id()
                    ]);
                    
                    $request->session()->regenerate();
                    return redirect()->intended(route('admin.dashboard'));
                } else {
                    Log::error('Failed to login using ID method');
                }
            }
        } catch (\Exception $e) {
            Log::error('Exception during admin manual login: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
        }

        Log::error('All admin login methods failed', [
            'email' => $request->email
        ]);
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Log the admin out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}