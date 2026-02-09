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
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your email is not verified. Please check your inbox for the verification link.',
                ], 403);
            }

            return redirect()->back()->withErrors([
                'email' => 'Your email is not verified. Please check your inbox for the verification link.',
            ])->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Welcome back, ' . Auth::user()->name . '! You have successfully logged in.',
                'redirect' => url('/')
            ]);
        }

        return redirect('/')->with('login_success', 'Welcome back, ' . Auth::user()->name . '! You have successfully logged in.');
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
