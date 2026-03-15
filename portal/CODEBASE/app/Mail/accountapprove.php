<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

class accountapprove extends Mailable implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {

    }

    public function build()
    {
        return $this->subject('UBID - Account Approved')
                            ->markdown('emails.accountapprove');
    }
    
}
?>