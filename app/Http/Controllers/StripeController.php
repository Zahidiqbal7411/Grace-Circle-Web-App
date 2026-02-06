<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    // This method shows the checkout page
    public function checkout()
    {
        return view('stripe.checkout');
    }

    // This method creates a Stripe checkout session and redirects the user
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
                    'unit_amount' => 1000, // 10 USD in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/success'),
            'cancel_url' => url('/cancel'),
        ]);

        return redirect($session->url);
    }

    // Shows payment success page
    public function success()
    {
        return view('stripe.success');
    }

    // Shows payment cancel page
    public function cancel()
    {
        return view('stripe.cancel');
    }
}
