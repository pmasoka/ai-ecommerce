<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterMail extends Mailable
{
    use SerializesModels;

    public $user;

    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    public function build()
    {
        return $this
            ->subject(
                'Welcome to AI Powered E-commerce'
            )
            ->view(
                'emails.register'
            );
    }
}