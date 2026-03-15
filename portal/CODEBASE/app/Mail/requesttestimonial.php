<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

class requesttestimonial extends Mailable implements ShouldQueue
{
    use Queueable;

    public $vendorid;
    public $message;
    public $name;

    public function __construct($data=[])
    {
        $this->data = $data;
        $this->vendorid = $data['vendorid'];
        $this->name = $data['name'];
        $this->message = $data['message'];
    }

    public function build()
    {
        return $this->subject('UBID - Request Testimonial')
                            ->with(['data'=>$this->data])
                            ->markdown('emails.requesttestimonial');
    }
    
}
?>