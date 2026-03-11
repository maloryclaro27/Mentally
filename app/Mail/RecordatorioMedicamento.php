<?php

namespace App\Mail;

use App\Models\Medicamento;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecordatorioMedicamento extends Mailable
{
    use Queueable, SerializesModels;

    public Medicamento $medicamento;
    public string $confirmUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Medicamento $medicamento, string $confirmUrl)
    {
        $this->medicamento = $medicamento;
        $this->confirmUrl = $confirmUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recordatorio de medicamento: ' . $this->medicamento->nombre,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.recordatorio-medicamento',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}