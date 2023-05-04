<?php

namespace App\Http\Controllers;

class BackendController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->data['siteTitle'] = 'Dashboard';

        if (!file_exists(storage_path('installed'))) {
            return redirect('/install')->send();
        }
    }
}
