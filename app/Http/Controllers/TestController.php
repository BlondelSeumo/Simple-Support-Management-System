<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    function index(Request $request) {

        if(auth()->id() != 1) {
            exit("You doesn't have access permission this request. please login as super admin.");
        }

        $query = $request->get('query');
        $email = $request->get('email');
        if($query == 'email') {
            return $this->sendEmailTest($email);
        }

    }

    private function sendEmailTest($email)
    {
        $message = "Your email configuration now successfully configure. You can send email now.";
        $email   = $email ?? "greensoftb@gmail.com";

        Mail::raw('Hi, welcome user! ' . $message, function ($message) use($email) {
            $message->to($email)
            ->subject("Testing Email");
        });
        dd('Check your email to check email configuration is ok or not.');
    }
}
