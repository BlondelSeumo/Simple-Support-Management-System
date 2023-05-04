<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

class SiteController extends FrontendController
{
    public function index()
    {
        return view('frontend.index', $this->data);
    }

    public function saveDeviceToken(Request $request)
    {
        if (!empty($request->device_token)) {
            auth()->user()->device_token = $request->device_token;
            auth()->user()->save();
            echo "Success";
        } else {
            echo "Not Success";
        }
    }
}
