<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Registration;

class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct(Registration $registration, $pdfPath)
    {
        //
        $this->registration = $registration;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registration Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
    // Need to change
    public function build()
    {
        // return $this->view('emails.registration-confirmation')
        //             ->subject('Registration Confirmation');
        
        return $this->subject('Registration Confirmation - SNTCSSC')
                    ->view('emails.registration_confirmation')
                    ->attach(storage_path('app/public/' . $this->pdfPath));
    }
}
