<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

class loginCredentials extends Mailable implements ShouldQueue
{
    use Queueable;

    public $email;
    public $password;


    public function __construct($data=[])
    {
        $this->data = $data;
        $this->email = $data['email'];
        $this->password = $data['password'];

    }

    public function build()
    {
        return $this->subject('UBID - Login credentials')
                            ->with(['data'=>$this->data])
                            ->markdown('emails.loginCredentials');
    }
    
}
?>