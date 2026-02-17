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
        'religion', 'cast', 'last_seen', 'email_status', 'email_verified_at',
        'profile_status',
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
     * Send the email verification notification with Triple-Retry Logic.
     * Mode 1: Native PHP mail() [Most reliable on Shared Hosting/cPanel]
     * Mode 2: Laravel Mailer [SMTP/Default]
     * Mode 3: Sendmail [Fallback]
     */
    public function sendEmailVerificationNotification()
    {
        $to = $this->email;
        $subject = 'Verify Your Email Address';
        $mailable = new \App\Mail\VerifyEmail($this);
        $fromEmail = config('mail.from.address', 'noreply@gracecircle.com');
        $fromName = config('mail.from.name', 'Grace Circle');

        \Log::info("Starting Triple-Retry email delivery for: $to");

        // Mode 1: Native PHP mail() - Usually bypasses external SMTP blockers
        try {
            $url = $this->verificationUrl();
            $htmlContent = view('emails.verify', ['user' => $this, 'verificationUrl' => $url])->render();
            
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: $fromName <$fromEmail>" . "\r\n";
            $headers .= "Reply-To: $fromEmail" . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            if (@mail($to, $subject, $htmlContent, $headers)) {
                \Log::info("Mode 1: Verification email sent successfully via Native PHP mail() to: $to");
                return;
            } else {
                \Log::warning("Mode 1: Native PHP mail() returned false for $to. Moving to Mode 2.");
            }
        } catch (\Exception $e) {
            \Log::warning("Mode 1: Native PHP mail() exception for $to: " . $e->getMessage() . ". Moving to Mode 2.");
        }

        // Mode 2: Laravel Default Mailer (SMTP / Failover)
        try {
            \Illuminate\Support\Facades\Mail::to($to)->send($mailable);
            \Log::info("Mode 2: Verification email sent successfully via Laravel Default Mailer to: $to");
            return;
        } catch (\Exception $e) {
            \Log::warning("Mode 2: Laravel Default Mailer failed for $to: " . $e->getMessage() . ". Moving to Mode 3.");
        }

        // Mode 3: Sendmail Fallback
        try {
            \Illuminate\Support\Facades\Mail::mailer('sendmail')->to($to)->send($mailable);
            \Log::info("Mode 3: Verification email sent successfully via Sendmail to: $to");
            return;
        } catch (\Exception $e) {
            \Log::error("All email verification attempts (Mode 1, 2, 3) failed for $to. Final check your server mail configuration. Error: " . $e->getMessage());
        }
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
            'email_status' => '1',
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

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'user_id', 'id');
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

    public function getProfileImageUrlAttribute()
    {
        // Check new images table first
        $newImg = $this->images->where('image_type', 'profile')->first();
        if ($newImg) {
            return asset($newImg->image_link);
        }

        // Check old galleries table as fallback
        $oldImg = $this->galleries->where('image_type', 'profile')->first();
        if ($oldImg) {
            return asset($oldImg->image_path);
        }

        // Return default placeholder
        return asset('img/photo/photo-1.jpg');
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

    /**
     * Get the payment record for this user.
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Check if user has a valid subscription (not expired beyond grace period).
     */
    public function hasValidSubscription(): bool
    {
        $payment = $this->payment;
        
        if (!$payment) {
            return false;
        }

        return !$payment->isExpiredBeyondGrace();
    }

    /**
     * Check if subscription needs payment (expired beyond grace period).
     */
    public function needsPayment(): bool
    {
        $payment = $this->payment;
        
        if (!$payment) {
            return true;
        }

        return $payment->isExpiredBeyondGrace();
    }

    /**
     * Get the number of days until subscription expires.
     */
    public function subscriptionExpiresInDays(): int
    {
        $payment = $this->payment;
        
        if (!$payment) {
            return 0;
        }

        return $payment->daysUntilExpiry();
    }

}