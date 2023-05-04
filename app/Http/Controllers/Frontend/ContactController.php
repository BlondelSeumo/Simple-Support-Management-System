<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;

class ContactController extends FrontendController
{
    public function index()
    {
        return view('frontend.contact.index', $this->data);
    }
}
