<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

class registerOtp extends Mailable implements ShouldQueue
{
    use Queueable;

    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;

    }

    public function build()
    {
        return $this->subject('UBID - OTP')
                            ->with(['otp', $this->otp])
                            ->markdown('emails.registerOtp');
    }
    
}
?>