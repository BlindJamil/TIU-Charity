<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20', 'unique:users,phone'],
            'city' => ['nullable', 'string', 'max:255'],
            'student_id' => ['nullable', 'string', 'max:50'],
            'department' => ['nullable', 'string', 'max:255'],
            'graduation_year' => ['nullable', 'string', 'max:4'],
            'address' => ['nullable', 'string', 'max:500'],
            'emergency_contact' => ['nullable', 'string', 'max:255'],
            'emergency_phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'student_id' => $request->student_id,
            'department' => $request->department,
            'graduation_year' => $request->graduation_year,
            'address' => $request->address,
            'emergency_contact' => $request->emergency_contact,
            'emergency_phone' => $request->emergency_phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
