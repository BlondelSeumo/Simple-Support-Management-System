<?php

namespace App\Http\Controllers\Install;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class PurchaseCodeController extends Controller
{

    public function index()
    {
        return view('install.purchase-code');
    }

    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'purchase_code' => 'required|string'
        ]);

        $validator->after(function ($validator) use ($request) {
            $result = $this->checkPurchaseCode($request);
            if (!$result['status']) {
                $validator->errors()->add('purchase_code', $result['message']);
            }
        });

        if ($validator->fails()) {
            return redirect(route('install.get-purchase-code'))->withErrors($validator)->withInput();
        }

        $request->session()->put('purchaseCode', $request->get('purchase_code'));

        return redirect(route('LaravelInstaller::environmentWizard'));
    }

    private function checkPurchaseCode($request)
    {
        $array['purchasecode'] = $request->get('purchase_code');
        $array['ipaddress'] = $request->ip();
        $array['hostname'] = URL::to('/');
        $array['appname'] = config('green.appname');
        $array['appversion'] = config('green.appversion');
        $array['status'] = 1;

        $ch = curl_init();
        $url = config('green.authorurl') . '/tracker/index';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Submit the POST request
        $result = curl_exec($ch);

        // Close cURL session ch
        curl_close($ch);

        return json_decode($result, true);
    }
}
