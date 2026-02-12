<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{

    /**
     * Subscription price in cents (e.g., 500 = $5.00 USD)
     */
    const SUBSCRIPTION_PRICE_CENTS = 500;
    const CURRENCY = 'usd';

    /**
     * Shows the subscription payment required page.
     */
    public function paymentRequired()
    {
        $user = Auth::user();
        $payment = $user->payment;
        
        $data = [
            'user' => $user,
            'payment' => $payment,
            'daysSinceExpiry' => $payment ? $payment->daysSinceExpiry() : 0,
            'isTrial' => $payment ? $payment->isTrial() : false,
            'subscriptionPrice' => number_format(self::SUBSCRIPTION_PRICE_CENTS / 100, 2),
            'currency' => strtoupper(self::CURRENCY),
        ];

        return view('stripe.payment-required', $data);
    }

    /**
     * Creates a Stripe checkout session for subscription payment.
     */
    public function createSubscriptionSession(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $user = Auth::user();

        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $user->email,
            'line_items' => [[
                'price_data' => [
                    'currency' => self::CURRENCY,
                    'product_data' => [
                        'name' => 'Grace Circle Premium Subscription',
                        'description' => '30-day premium membership access',
                    ],
                    'unit_amount' => self::SUBSCRIPTION_PRICE_CENTS,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('subscription.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscription.cancel'),
            'metadata' => [
                'user_id' => $user->id,
            ],
        ]);

        return redirect($session->url);
    }

    /**
     * Handles successful subscription payment.
     */
    public function subscriptionSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');
        $user = Auth::user();

        if ($sessionId) {
            try {
                Stripe::setApiKey(config('services.stripe.secret'));
                $session = Session::retrieve($sessionId);

                // Update or create payment record
                $payment = $user->payment;
                
                if ($payment) {
                    $payment->stripe_checkout_session_id = $sessionId;
                    $payment->stripe_payment_id = $session->payment_intent;
                    $payment->amount = self::SUBSCRIPTION_PRICE_CENTS / 100;
                    $payment->currency = strtoupper(self::CURRENCY);
                    $payment->payment_method = 'card';
                    $payment->extendSubscription(Payment::SUBSCRIPTION_PERIOD_DAYS);
                } else {
                    Payment::create([
                        'user_id' => $user->id,
                        'valid_till' => Carbon::now()->addDays(Payment::SUBSCRIPTION_PERIOD_DAYS),
                        'stripe_checkout_session_id' => $sessionId,
                        'stripe_payment_id' => $session->payment_intent,
                        'amount' => self::SUBSCRIPTION_PRICE_CENTS / 100,
                        'currency' => strtoupper(self::CURRENCY),
                        'status' => 'completed',
                        'payment_method' => 'card',
                    ]);
                }

                // Get the updated payment for display
                $user->refresh();
                $payment = $user->payment;

                // Regenerate session to ensure middleware recognizes the new payment status
                $request->session()->regenerate();
                
                // Force refresh auth user data
                auth()->setUser($user->fresh());

                return redirect()->route('home')->with('success', 'Payment Successful! Your premium subscription is now active until ' . $payment->valid_till->format('F j, Y'));
            } catch (\Exception $e) {
                return redirect()->route('subscription.required')
                    ->with('error', 'There was an issue processing your payment. Please try again.');
            }
        }

        return redirect()->route('subscription.required')
            ->with('error', 'Payment was not completed. Please try again.');
    }

    /**
     * Handles cancelled subscription payment.
     */
    public function subscriptionCancel()
    {
        return redirect()->route('subscription.required')
            ->with('error', 'Payment was cancelled. Please complete the payment to access your dashboard.');
    }

    // -------------------------------------------------------------------------
    // Original checkout methods (kept for backwards compatibility)
    // -------------------------------------------------------------------------


    public function checkout()
    {
        return view('stripe.checkout');
    }

    /**
     * Creates a Stripe checkout session and redirects the user (original implementation).
     */
    public function createSession(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Test Product',
                    ],
                    'unit_amount' => 1000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/success'),
            'cancel_url' => url('/cancel'),
        ]);

        return redirect($session->url);
    }

    /**
     * Shows payment success page (original implementation).
     */
    public function success()
    {
        return redirect()->route('home')->with('success', 'Payment Successful! Your premium subscription is now active.');
    }

    /**
     * Shows payment cancel page (original implementation).
     */
    public function cancel()
    {
        return view('stripe.cancel');
    }
}
