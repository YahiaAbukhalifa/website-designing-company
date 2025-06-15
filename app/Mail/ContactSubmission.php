<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('New Contact Us Submission')
                    ->view('emails.contact_submission')
                    ->with(['contact' => $this->contact]);
    }
}