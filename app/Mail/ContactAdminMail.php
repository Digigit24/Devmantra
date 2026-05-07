<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $email,
        public ?string $phone,
        public string $enquirySubject,
        public string $userMessage,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Enquiry on Website: ' . $this->enquirySubject,
            replyTo: [new Address($this->email, $this->name)],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-admin',
        );
    }
}
