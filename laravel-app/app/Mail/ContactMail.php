<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable {
    use Queueable, SerializesModels;

    public function __construct(public array $data) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data['subject'],
            replyTo: [
                new Address(
                    $this->data['email'],
                    $this->data['name']
                ),
            ]
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact'
        );
    }

    public function attachments(): array
    {
        $attachments = [];

        if ($this->data['document'] && $this->data['document']->isValid()) {
            $attachments[] = Attachment::fromData(
                fn() => $this->data['document']->get(),
                'contact_document.pdf'
            )->withMime('application/pdf');
        }

        return $attachments;
    }
}