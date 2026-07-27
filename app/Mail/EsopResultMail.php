<?php

namespace App\Mail;

use App\Models\EsopLead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EsopResultMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  \App\Models\EsopEmployee[]  $employees
     * @param  array<string,mixed>  $calc  EsopAllocationCalculator::calculateSession() output
     * @param  array<string,mixed>  $aiContent  ['overall' => [...], 'employees' => [id => [...]]]
     */
    public function __construct(
        public EsopLead $lead,
        public array $employees,
        public array $calc,
        public array $aiContent,
        public ?string $reportUrl = null,
    ) {}

    public function envelope(): Envelope
    {
        $company = trim((string) $this->lead->company) !== '' ? trim($this->lead->company) : 'Your Company';

        return new Envelope(
            subject: 'Your ESOP Allocation Report · ' . $company,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.esop-result',
            with: [
                'lead'       => $this->lead,
                'employees'  => collect($this->employees),
                'pool'       => $this->calc['pool'],
                'calc'       => $this->calc['employees'],
                'aiContent'  => $this->aiContent,
                'reportUrl'  => $this->reportUrl,
            ],
        );
    }
}
