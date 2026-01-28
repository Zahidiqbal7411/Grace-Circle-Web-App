<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        // Generate signed verification URL
        $verificationUrl = $this->user->verificationUrl();

        return $this->view('emails.verify')
                    ->with([
                        'verificationUrl' => $verificationUrl,
                        'user' => $this->user
                    ])
                    ->subject('Verify Your Email Address');
    }
}
