<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

class ticketraise extends Mailable implements ShouldQueue
{
    use Queueable;

    public $name;
    public $ticket_id;
    public $vendor_id;
    public $category;
    public $created_at;
    public $description;

    public function __construct($data=[])
    {
        $this->data = $data;
        $this->name = $data['name'];
        $this->ticket_id = $data['ticket_id'];
        $this->vendor_id = $data['vendor_id'];
        $this->category = $data['category'];
        $this->created_at = $data['created_at'];
        $this->description = $data['description'];

    }

    public function build()
    {
        return $this->subject('UBID - Ticket Raised')
                            ->with(['data'=>$this->data])
                            ->markdown('emails.ticketraise');
    }
    
}
?>