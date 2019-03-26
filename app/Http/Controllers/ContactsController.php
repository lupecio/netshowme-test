<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Business\ContactBusiness;
use App\Utils\Messages;
use App\Http\Requests\ContactRequest;

class ContactsController extends Controller
{
    private $business;

    public function __construct(ContactBusiness $business)
    {
        $this->business = $business;
    }

    public function store(ContactRequest $request)
    {
        $contact = $this->business->store($request);

        return response()->json([
            "message" => Messages::SUCCESS,
            "data" => $contact
        ], Response::HTTP_CREATED);
    }
}
