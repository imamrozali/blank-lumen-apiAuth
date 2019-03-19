<?php

namespace App\Mail\Auth;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $username = $this->user->username;
        $email    = $this->user->email;
        $token    = $this->user->pendingVerifications()
            ->where('email', $this->user->email)
            ->firstOrFail()
            ->token;
        
        return $this
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Account verification')
            ->view('emails.auth.verify')
            ->with([
                'username' => $username,
                'email'    => $email,
                'token'    => $token
            ]);
    }
}
