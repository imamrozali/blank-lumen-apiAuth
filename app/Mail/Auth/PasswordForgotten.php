<?php

namespace App\Mail\Auth;

use App\PasswordReset;
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
     * @var PasswordReset
     */
    private $user;
    private $pswReset;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, PasswordReset $pswReset)
    {
        $this->user = $user;
        $this->psw  = $pswReset;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject(env('Password reset'))
            ->view('emails.auth.psw-reset')
            ->with([
                'username' => $this->user->username,
                'email'    => $this->psw->email,
                'token'    => $this->psw->token
            ]);
    }
}
