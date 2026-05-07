<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $email,
        public string $enquirySubject,
        public string $userMessage,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank you for contacting DevMantra',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-user',
        );
    }
}
