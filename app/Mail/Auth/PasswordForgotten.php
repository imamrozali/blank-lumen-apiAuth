<?php

namespace App\Mail\Auth;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordForgotten extends Mailable
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
            ->where('password_reset', true)
            ->where('user_id', $this->user->id)
            ->firstOrFail()
            ->token;

        return $this
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Password reset')
            ->view('emails.auth.psw-reset')
            ->with([
                'username' => $username,
                'email'    => $email,
                'token'    => $token
            ]);
    }
}
