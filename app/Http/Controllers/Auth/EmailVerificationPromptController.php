<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt or success message.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        // If user is verified, show success state of verify-email page
        if ($request->user()->hasVerifiedEmail()) {
            return view('auth.verify-email', ['isSuccess' => true]);
        }
        
        // Otherwise show the prompt to verify
        return view('auth.verify-email');
    }
}
