<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    public function store(LoginRequest $request): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        $request->authenticate();

        if (Auth::user()->email_status != 1) {
            // Do NOT logout here. The 'verified' middleware on protected routes will handle the restriction.
            // Just redirect them to the verification notice page.
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Please verify your email address.',
                    'redirect' => route('verification.notice')
                ]);
            }

            return redirect()->route('verification.notice');
        }

        $request->session()->regenerate();
        
        // Force refresh auth user data to ensure dashboard loads properly
        auth()->setUser(Auth::user()->fresh());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Welcome back, ' . Auth::user()->name . '! You have successfully logged in.',
                'redirect' => route('dashboard')
            ]);
        }

        return redirect()->intended(route('dashboard'))->with('login_success', 'Welcome back, ' . Auth::user()->name . '! You have successfully logged in.');
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
