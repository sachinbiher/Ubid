<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

class accountreject extends Mailable implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {

    }

    public function build()
    {
        return $this->subject('UBID - Account Rejected')
                            ->markdown('emails.accountreject');
    }
    
}
?>