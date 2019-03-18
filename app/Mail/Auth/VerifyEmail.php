<?php

namespace App\Mail\Auth;

use App\UserVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var UserVerification
     */
    private $userVerification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserVerification $userVerification)
    {
        $this->userVerification = $userVerification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $username = $this->userVerification->user()->username;
        $token    = $this->userVerification->token;

        if ($this->userVerification->email != null) {
            $email = $this->userVerification->email;
        } else {
            $email = $this->userVerification->email_two;
        }
        
        return $this
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject(env('E-mail verification'))
            ->view('emails.auth.verify')
            ->with([
                'username' => $username,
                'email'    => $email,
                'token'    => $token
            ]);
    }
}
