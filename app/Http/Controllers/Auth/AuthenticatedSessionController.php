<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

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
    public function store(LoginRequest $request): RedirectResponse
    {
         $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required', 'in:0,1'], // Validate the role field
        ]);
        $credentials = $request->only('email', 'password');
        $role = $request->input('role');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user's role matches the selected role
            if ($user->role == $role) {
                // Redirect based on role
                if ($user->role == 1) {
                    return redirect()->intended('/admin/dashboard'); // Redirect admin
                } else {
                    return redirect()->intended('/customer/dashboard'); // Redirect regular user
                }
            } else {
                Auth::logout();
                throw ValidationException::withMessages([
                    'role' => 'The selected role does not match your account.',
                ]);
            }
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
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
