<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $permission The permission name passed from the route definition
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        // Ensure the user is logged in via the 'admin' guard
        if (!Auth::guard('admin')->check()) {
            // Redirect to admin login if not authenticated
            return redirect()->route('admin.login');
        }

        // Get the authenticated admin user
        $admin = Auth::guard('admin')->user();

        // Check if the admin has the required permission using the hasPermission method on the Admin model.
        if ($admin && $admin->hasPermission($permission)) {
            // User has the permission, proceed with the request
            return $next($request);
        }

        // If the user doesn't have the permission, abort with 403 Forbidden
        abort(403, 'Unauthorized action.');
    }
}