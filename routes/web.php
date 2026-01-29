<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Models\User;

use App\Http\Controllers\MemberDetailController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth', 'verified'])->group(function () {
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

require __DIR__.'/auth.php';
