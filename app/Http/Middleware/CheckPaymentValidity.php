<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPaymentValidity
{
    /**
     * Handle an incoming request.
     *
     * Checks if the user has a valid subscription:
     * - If no payment record exists, redirect to payment page
     * - If subscription expired beyond 3-day grace period, redirect to payment page
     * - If within grace period, allow access (optional: show warning)
     * - If valid, allow normal access
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // If user is not authenticated, let other middleware handle it
        if (!$user) {
            return $next($request);
        }

        // Check if user needs to make a payment
        if ($user->needsPayment()) {
            // Store the intended URL for redirect after payment
            session()->put('url.intended', $request->url());
            
            // Redirect to payment required page
            return redirect()->route('subscription.required');
        }

        // Optional: Check if within grace period and set a session flag for warning
        $payment = $user->payment;
        if ($payment) {
            if ($payment->isWithinGracePeriod()) {
                session()->flash('subscription_warning', true);
                session()->flash('subscription_days_expired', $payment->daysSinceExpiry());
            } elseif ($payment->isValid() && $payment->daysUntilExpiry() <= 1) {
                // If trial or subscription ending in <= 1 day
                session()->flash('subscription_expiring_soon', true);
                session()->flash('subscription_days_left', $payment->daysUntilExpiry());
            }
        }

        return $next($request);
    }
}
