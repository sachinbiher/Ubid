<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

class ticketraisevendor extends Mailable implements ShouldQueue
{
    use Queueable;

    public $name;
    public $ticket_id;

    public function __construct($data=[])
    {
        $this->data = $data;
        $this->name = $data['name'];
        $this->ticket_id = $data['ticket_id'];
    }

    public function build()
    {
        return $this->subject('UBID - Ticket Raised')
                            ->with(['data'=>$this->data])
                            ->markdown('emails.ticketraisevendor');
    }
    
}
?>