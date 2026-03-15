<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

class ticketupdate extends Mailable implements ShouldQueue
{
    use Queueable;

    public $name;
    public $ticket_id;
    public $status;
    public $created_at;

    public function __construct($data=[])
    {
        $this->data = $data;
        $this->name = $data['name'];
        $this->ticket_id = $data['ticket_id'];
        $this->status = $data['status'];
        $this->created_at = $data['created_at'];

    }

    public function build()
    {
        return $this->subject('UBID - Ticket Update')
                            ->with(['data'=>$this->data])
                            ->markdown('emails.ticketupdate');
    }
    
}
?>