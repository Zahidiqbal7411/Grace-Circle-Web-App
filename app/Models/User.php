<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL; // Required for URL generation
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'gender', 'age', 'country', 'city', 
        'birthday', 'relationship_status', 'looking_for', 'work_as', 
        'education', 'languages', 'interests', 'smoking', 'eye_color', 
        'religion', 'cast', 'last_seen', 'email_status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'last_seen' => 'datetime',
        ];
    }

    /**
     * Send the email verification notification.
     * Overriding to use our custom VerifyEmail mailable.
     */
    public function sendEmailVerificationNotification()
    {
        \Illuminate\Support\Facades\Mail::to($this->email)->send(new \App\Mail\VerifyEmail($this));
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
            'email_status' => 1,
        ])->save();
    }

    /**
     * Generate the signed URL for email verification.
     * This fixes the "Call to a member function verificationUrl() on string" error.
     */
    public function verificationUrl()
    {
        return URL::temporarySignedRoute(
            'verification.verify', // Ensure this route name exists in your routes/web.php
            Carbon::now()->addMinutes(60),
            [
                'id' => $this->id,
                'hash' => sha1($this->email),
            ]
        );
    }

    /* --- Relationships --- */

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class, 'user_id', 'id');
    }

    public function friendRequestsSent(): HasMany
    {
        return $this->hasMany(Friend::class, 'request_from');
    }

    public function friendRequestsReceived(): HasMany
    {
        return $this->hasMany(Friend::class, 'request_to');
    }

    public function sentMessages(): HasMany
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }

    public function blockedUsers(): HasMany
    {
        return $this->hasMany(Block::class, 'block_by');
    }

    public function blockedByUsers(): HasMany
    {
        return $this->hasMany(Block::class, 'block_user');
    }

    /* --- Helpers --- */

    public function isOnline()
    {
        return $this->last_seen && $this->last_seen->gt(Carbon::now()->subMinutes(5));
    }


    /**
     * Get the questions answered by this user.
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'user_question_answers')
                    ->withPivot('answer_text')
                    ->withTimestamps();
    }

}