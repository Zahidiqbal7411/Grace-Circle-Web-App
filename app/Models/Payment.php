<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'valid_till',
        'stripe_payment_id',
        'stripe_checkout_session_id',
        'amount',
        'currency',
        'status',
        'payment_method',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'valid_till' => 'datetime',
        'amount' => 'decimal:2',
    ];

    /**
     * Grace period in days after subscription expires.
     */
    const GRACE_PERIOD_DAYS = 3;

    /**
     * Default trial period in days for new users.
     */
    const TRIAL_PERIOD_DAYS = 3;

    /**
     * Subscription period in days after successful payment.
     */
    const SUBSCRIPTION_PERIOD_DAYS = 30;

    /**
     * Get the user that owns this payment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the subscription is currently valid (not expired).
     */
    public function isValid(): bool
    {
        return $this->valid_till && $this->valid_till->isFuture();
    }

    /**
     * Check if within the grace period (expired but within 3 days).
     */
    public function isWithinGracePeriod(): bool
    {
        if ($this->isValid()) {
            return false;
        }

        $expiryDate = $this->valid_till;
        $gracePeriodEnd = $expiryDate->copy()->addDays(self::GRACE_PERIOD_DAYS);

        return Carbon::now()->lte($gracePeriodEnd);
    }

    /**
     * Check if subscription has expired beyond the grace period.
     * This is when we should block dashboard access.
     */
    public function isExpiredBeyondGrace(): bool
    {
        if ($this->isValid()) {
            return false;
        }

        // Trial users get NO grace period - block immediately
        if ($this->isTrial()) {
            return true;
        }

        $expiryDate = $this->valid_till;
        $gracePeriodEnd = $expiryDate->copy()->addDays(self::GRACE_PERIOD_DAYS);

        return Carbon::now()->gt($gracePeriodEnd);
    }

    /**
     * Get the number of days until expiry (negative if expired).
     */
    public function daysUntilExpiry(): int
    {
        return Carbon::now()->diffInDays($this->valid_till, false);
    }

    /**
     * Get the number of days since expiry (0 if not expired).
     */
    public function daysSinceExpiry(): int
    {
        if ($this->isValid()) {
            return 0;
        }
        // Use absolute difference to avoid negatives in display
        return (int) abs(Carbon::now()->diffInDays($this->valid_till));
    }

    /**
     * Check if this is a trial subscription.
     */
    public function isTrial(): bool
    {
        return $this->status === 'trial';
    }

    /**
     * Extend the subscription by the given number of days.
     */
    public function extendSubscription(int $days = null): bool
    {
        $days = $days ?? self::SUBSCRIPTION_PERIOD_DAYS;
        
        // If subscription is still valid, extend from valid_till
        // Otherwise, extend from now
        $baseDate = $this->isValid() ? $this->valid_till : Carbon::now();
        
        $this->valid_till = $baseDate->copy()->addDays($days);
        $this->status = 'completed';
        
        return $this->save();
    }
}
