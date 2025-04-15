<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Thank you for contacting us!')
                    ->markdown('emails.contact.user-notification')
                    ->with([
                        'name' => $this->data['name'],
                        'message' => $this->data['message'],
                        'subject' => $this->data['subject']
                    ]);
    }
} 