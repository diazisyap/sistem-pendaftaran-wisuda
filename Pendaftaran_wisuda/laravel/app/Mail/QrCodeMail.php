<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Pendaftaran;

class QrCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftaran;

    public function __construct(Pendaftaran $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tiket QR Code Wisuda Anda - Siap Diunduh',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.qrcode',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
