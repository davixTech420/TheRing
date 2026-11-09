<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StaffAssignmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public Event $event;
    public Staff $staff;
    public string $token;
    public string $confirmUrl;
    public string $declineUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Event $event, Staff $staff, string $token)
    {
        $this->event = $event;
        $this->staff = $staff;
        $this->token = $token;
        $this->confirmUrl = route('staff.confirm', ['token' => $token]);
        $this->declineUrl = route('staff.decline', ['token' => $token]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "🔔 Asignación de Evento: {$this->event->name} - The Ring",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.staff-assignment',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}

