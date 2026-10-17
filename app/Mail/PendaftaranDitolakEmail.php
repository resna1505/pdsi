<?php

namespace App\Mail;

use App\Models\Anggota;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PendaftaranDitolakEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $anggota;

    public function __construct(Anggota $anggota)
    {
        $this->anggota = $anggota;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pendaftaran Anggota PDSI Ditolak',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pendaftaran-ditolak',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
