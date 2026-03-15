<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

class SubscriberMail extends Mailable implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {

    }

    public function build()
    {
        return $this->subject('UBID- The wait is Over!')
                            ->markdown('emails.subscribers');
    }

}