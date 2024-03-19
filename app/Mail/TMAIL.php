<?php

// app/Mail/MyEmail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TMAIL extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;
    public $name;
    public $code;
    public $email;
    public function __construct($subject, $message, $name, $code, $email)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->name = $name;
        $this->code = $code;
        $this->email = $email;
    }

    public function build()
    {
        return $this->view('emails.template')
                    ->subject($this->subject)
                    ->from("tyronemalocon@gmail.com","OVMS")
                    ->with([
                        'text' => $this->message,
                        'subject' => $this->subject,
                        'name' => $this->name,
                        'code' => $this->code,
                        'email' => $this->email,
                        "link" =>  url('/')
                    ]);
    }
}

?>