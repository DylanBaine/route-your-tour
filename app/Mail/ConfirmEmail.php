<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Auth;

class ConfirmEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::user();     
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('mailbot@routeyourtour.com')
                    ->markdown('mail.verifyEmail')
                    ->with([
                        'name' => $this->user->name,
                        'url' => url('verifying/' . $this->user->email_confirmed_token)
                    ]);
    }
}
