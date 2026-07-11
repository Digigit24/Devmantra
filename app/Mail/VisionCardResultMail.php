<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisionCardResultMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array<string, mixed>  $blueprint  The generated ai_content payload.
     */
    public function __construct(
        public string $name,
        public string $company,
        public array $blueprint,
    ) {}

    public function envelope(): Envelope
    {
        $company = trim($this->company) !== '' ? trim($this->company) : 'Your Business';

        return new Envelope(
            subject: 'Your Growth Blueprint · ' . $company,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.vision-card-result',
            with: [
                'name'      => $this->name,
                'company'   => $this->company,
                'blueprint' => $this->blueprint,
            ],
        );
    }
}
