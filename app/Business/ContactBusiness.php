<?php

namespace App\Business;

use App\Contact;
use App\Mail\ContactInformation;
use Illuminate\Support\Facades\Mail;

class ContactBusiness {

    public function store($request)
    {
        $contact = new Contact();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->ip = $request->ip();
        $contact->send_at = now();
        $contact->url = $request->file->store('contacts');

        $contact->save();

        $this->sendEmail($contact);

        return $contact;
    }

    private function sendEmail($contact)
    {
        Mail::to(env('EMAIL_REFERENCE'))->send(new ContactInformation($contact));
    }
}
