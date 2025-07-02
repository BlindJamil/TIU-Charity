<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }
    
    /**
     * Handle an incoming authentication request.
     */
    
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $login = $request->input('login');
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        // Determine if login is email or phone
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$fieldType => $login, 'password' => $password], $remember)) {
            $request->session()->regenerate();

            // ✅ Redirect based on role
            if (DB::table('admins')->where('user_id', Auth::id())->exists()) {
                return redirect('/admin/dashboard');
            }

            return redirect()->route('home'); // Normal users go to home
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }




    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
