<?php

namespace App\Mail;

use App\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactInformation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact')
                    ->subject('Novo Contato Recebido')
                    ->with([
                        'name' => $this->contact->name,
                        'email' => $this->contact->email,
                        'phone' => $this->contact->phone,
                        'message' => $this->contact->message
                    ])
                    ->attachFromStorage($this->contact->url);
    }
}
