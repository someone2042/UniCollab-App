<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RemoveGroupMail extends Mailable
{
    use Queueable, SerializesModels;
    public $group;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $group)
    {
        $this->user = $user;
        $this->group = $group;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Important Information Regarding ' . $this->group . ' Team Group on UniCollab',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.removeGroup',
            with: [
                'name' => $this->user,
                'group' => $this->group,
            ],
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
