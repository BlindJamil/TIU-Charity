<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // First check if admin is logged in via admin guard
        if (Auth::guard('admin')->check()) {
            Log::info('Admin authenticated via admin guard', [
                'admin_id' => Auth::guard('admin')->id(),
                'admin_email' => Auth::guard('admin')->user()->email
            ]);
            return $next($request);
        }
        
        // If admin guard fails, check if the user is authenticated and has admin role
        if (Auth::check()) {
            $user = Auth::user();
            
            // Check if user is linked to an admin account
            $admin = \DB::table('admin_users')->where('email', $user->email)->first();
            
            if ($admin) {
                // Check if the admin has the required role
                $hasRole = \DB::table('admin_role_user')
                    ->join('admin_roles', 'admin_roles.id', '=', 'admin_role_user.admin_role_id')
                    ->where('admin_user_id', $admin->id)
                    ->where(function($query) {
                        $query->where('admin_roles.name', 'super_admin')
                              ->orWhere('admin_roles.name', 'admin');
                    })
                    ->exists();
                    
                if ($hasRole) {
                    // Login as admin
                    Auth::guard('admin')->loginUsingId($admin->id);
                    Log::info('User authenticated as admin via role check', [
                        'user_id' => $user->id,
                        'admin_id' => $admin->id
                    ]);
                    return $next($request);
                }
            }
        }

        Log::warning('Unauthorized admin access attempt', [
            'user_authenticated' => Auth::check(),
            'admin_authenticated' => Auth::guard('admin')->check(),
            'path' => $request->path(),
            'ip' => $request->ip()
        ]);
        
        return abort(403, 'Unauthorized');
    }
}
