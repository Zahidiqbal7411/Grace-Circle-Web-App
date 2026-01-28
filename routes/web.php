<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Models\User;

Route::get('/', function () {
    return view('index');
});








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

Route::get('/email/verify/success', function () {
    $user = null;
    if (session('verified_user_id')) {
        $user = User::find(session('verified_user_id'));
    }
    return view('auth.verify-success', compact('user'));
})->name('verification.success');

Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    // 1. Find the user or fail
    $user = User::findOrFail($id);

    // 2. Verify if the hash matches the user's email
    if (!hash_equals((string) $hash, sha1($user->email))) {
        abort(403, 'Invalid verification link.');
    }

    // 3. Check if already verified
    if ($user->email_verified_at) {
        return redirect('/')->with('message', 'Email already verified. Please login.');
    }

    // 4. Mark as verified by setting email_verified_at to current timestamp
    $user->email_verified_at = now();
    $user->save();

    // 5. Redirect to success page with user info
    return redirect()->route('verification.success')->with('verified_user_id', $user->id);
})->middleware(['signed'])->name('verification.verify');

require __DIR__.'/auth.php';
