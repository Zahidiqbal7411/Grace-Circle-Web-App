<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Models\User;

use App\Http\Controllers\MemberDetailController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;


Route::get('/', function () {
    return view('index');
});

// Protected routes - require auth, verified email, AND valid payment
Route::middleware(['auth', 'verified', 'payment.valid'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/members', [MemberDetailController::class, 'members'])->name('members');
    Route::get('/members/{id}', [MemberDetailController::class, 'member_details'])->name('member.details');
    Route::post('/members/search', [MemberDetailController::class, 'search'])->name('member.search');

    Route::get('/profile/edit/{id}', [UserProfileController::class, 'profile_edit'])->name('user.profile.edit');
    Route::post('/profile/autosave', [UserProfileController::class, 'autoSave'])->name('user.autosave');
    Route::post('/profile/image', [UserProfileController::class, 'store'])->name('user.image.store');
    
    Route::get('/block/{user}', [UserProfileController::class, 'user_block'])->name('user.block');
    Route::get('/unblock/{id}', [UserProfileController::class, 'unblock'])->name('user.unblock');

    Route::get('/friend/add/{id}', [FriendController::class, 'add_friend'])->name('add.friend');
    Route::get('/friend/accept/{id}/{user_id}', [FriendController::class, 'accept_request'])->name('accept.request');
    Route::get('/friend/cancel/{id}/{user_id}', [FriendController::class, 'cancel_request'])->name('cancel.request');

    Route::get('/chat', [ChatController::class, 'chat_create'])->name('chat');
    Route::post('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/store', [ChatController::class, 'store'])->name('chat.store');
    Route::post('/chat/fetch', [ChatController::class, 'fetchChat'])->name('chat.fetch');
});

// Subscription/Payment routes - only require auth (not payment.valid as these are for making payment)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/subscription/required', [StripeController::class, 'paymentRequired'])->name('subscription.required');
    Route::post('/subscription/checkout', [StripeController::class, 'createSubscriptionSession'])->name('subscription.checkout');
    Route::get('/subscription/success', [StripeController::class, 'subscriptionSuccess'])->name('subscription.success');
    Route::get('/subscription/cancel', [StripeController::class, 'subscriptionCancel'])->name('subscription.cancel');
});

// Original Stripe routes (kept for backwards compatibility)
Route::get('/checkout', [StripeController::class, 'checkout']);
Route::post('/checkout', [StripeController::class, 'createSession']);
Route::get('/success', [StripeController::class, 'success']);
Route::get('/cancel', [StripeController::class, 'cancel']);


Route::get('email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::findOrFail($id);

    if (!hash_equals((string) $hash, sha1($user->email))) {
        abort(403, 'Invalid verification link.');
    }

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    auth()->login($user);

    // Direct redirect to homepage with success message
    return redirect('/?verified=1');
})->middleware(['signed'])->name('verification.verify');

Route::get('/email/verify/status', function () {
    return response()->json([
        'verified' => auth()->user()->hasVerifiedEmail()
    ]);
})->middleware(['auth'])->name('verification.status');

Route::get('/send-test-email', function() {
    // 1. Find the user by the email you want to test
    $user = User::where('email', 'Webtechfusion64@gmail.com')->first();

    // 2. Check if the user exists to avoid a null error
    if (!$user) {
        return 'User not found in database. Please register this email first.';
    }

    // 3. Pass the $user OBJECT, not a string
    Mail::to($user->email)->send(new VerifyEmail($user));
    
    return 'Email sent!';
});



// Helper route to force subscription expiry for testing
Route::get('/test-expire-subscription', function() {
    $user = auth()->user();
    if (!$user) return 'Please login first';
    
    // Create or update payment to be expired
    if ($user->payment) {
        $user->payment->update([
            'valid_till' => now()->subDays(5), // Expired 5 days ago (beyond 3 day grace period)
            'status' => 'expired'
        ]);
    } else {
        $user->payment()->create([
            'valid_till' => now()->subDays(5),
            'status' => 'expired',
            'amount' => 0,
            'currency' => 'USD'
        ]);
    }
    
    return redirect()->route('dashboard')->with('status', 'Subscription forced to expired! You should be redirected to payment page.');
});

// Diagnostic route to check database and emails
Route::get('/db-check', function() {
    try {
        $dbName = DB::connection()->getDatabaseName();
        $users = User::all(['id', 'email']);
        return response()->json([
            'status' => 'Testing Connection...',
            'connected_database' => $dbName,
            'user_count' => $users->count(),
            'all_emails_in_db' => $users->pluck('email'),
            'tip' => 'If this list is not empty, you have users! If you dont see them in phpMyAdmin, you are looking at the WRONG database.'
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});

require __DIR__.'/auth.php';
