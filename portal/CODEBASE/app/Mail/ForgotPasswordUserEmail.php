<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

class ForgotPasswordUserEmail extends Mailable implements ShouldQueue
{
    use Queueable;

    public $password;

    public function __construct($password)
    {
        $this->password = $password;

    }

    public function build()
    {
        return $this->subject('UBID - New password')
                            ->with(['password', $this->password])
                            ->markdown('emails.forgotPasswordUserEmail');
    }
    
}
?>