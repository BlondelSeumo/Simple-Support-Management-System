<?php

namespace App\Http\Controllers;

class FrontendController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->data['siteTitle']  = 'Frontend';

        if (!file_exists(storage_path('installed'))) {
            return redirect('/install')->send();
        }
    }
}
