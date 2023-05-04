<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BackendController;
use App\Libraries\GreenSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Setting;

class SettingController extends BackendController
{
    public function __construct()
    {
        $this->middleware(['permission:setting'])->only('index', 'store');
    }

    public function index()
    {
        $this->data['timezones'] = GreenSupport::timezones();
        return view('backend.setting.index', $this->data);
    }

    public function store(Request $request)
    {
        $settingtype = request('settingtype') ?? 'generalsetting';
        Setting::set(['settingtype' => $settingtype]);
        Setting::save();

        if ($settingtype == 'generalsetting') {
            $this->generalStore($request);
        }

        if ($settingtype == 'emailsettting') {
            $this->emailStore($request);
        }

        if ($settingtype == 'pagesettting') {
            $this->pageStore($request);
        }

        return redirect(route('admin.setting.index'))->withSuccess('The setting updated successfully.');
    }

    private function generalStore($request)
    {
        $niceNames = [];
        $generalArray = $this->validate($request, $this->generalValidateArray(), [], $niceNames);

        $generalArray['site_name'] = request('site_name');
        $generalArray['address'] = request('address');
        $generalArray['copyright_by'] = request('copyright_by');

        if ($request->hasFile('site_logo')) {
            $generalArray['site_logo'] = $request->site_logo->hashName();
            $generalArray['site_favicon'] = $generalArray['site_logo'];
            $request->site_logo->move(public_path('image'), $generalArray['site_logo']);
        } else {
            unset($generalArray['site_logo']);
        }

        if (isset($generalArray['timezone'])) {
            GreenSupport::setEnv('APP_TIMEZONE', $generalArray['timezone']);
            Artisan::call('config:clear');
        }

        Setting::set($generalArray);
        Setting::save();
    }

    private function emailStore($request)
    {
        $niceNames = [];
        $emailArray = $this->validate($request, $this->emailValidateArray(), [], $niceNames);

        if (isset($emailArray['mail_host'])) {
            GreenSupport::setEnv('MAIL_HOST', $emailArray['mail_host']);
        }
        if (isset($emailArray['mail_port'])) {
            GreenSupport::setEnv('MAIL_PORT', $emailArray['mail_port']);
        }
        if (isset($emailArray['mail_username'])) {
            GreenSupport::setEnv('MAIL_USERNAME', $emailArray['mail_username']);
        }
        if (isset($emailArray['mail_password'])) {
            GreenSupport::setEnv('MAIL_PASSWORD', $emailArray['mail_password']);
        }
        if (isset($emailArray['mail_encryption'])) {
            GreenSupport::setEnv('MAIL_ENCRYPTION', $emailArray['mail_encryption']);
        }
        if (isset($emailArray['mail_from_address'])) {
            GreenSupport::setEnv('MAIL_FROM_ADDRESS', $emailArray['mail_from_address']);
        }
        Artisan::call('config:clear');

        Setting::set($emailArray);
        Setting::save();
    }

    private function pageStore($request)
    {
        $niceNames = [];
        $pageArray = $this->validate($request, $this->pageValidateArray(), [], $niceNames);

        Setting::set($pageArray);
        Setting::save();
    }

    private function generalValidateArray(): array
    {
        return [
            'site_name' => 'required|string|max:100',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'copyright_by' => 'required|string',
            'site_logo' => 'nullable|mimes:jpeg,jpg,png,gif|max:3096',
            'timezone' => 'required|string',
            'onesignal_app_id' => 'nullable|string',
            'onesignal_subdomain_name' => 'nullable|string',
            'google_map' => 'nullable|string',
        ];
    }

    private function emailValidateArray(): array
    {
        return [
            'mail_host' => 'required|string|max:100',
            'mail_port' => 'required|string|max:100',
            'mail_username' => 'required|string|max:100',
            'mail_password' => 'required|string|max:100',
            'mail_from_address' => 'required|string|max:100',
            'mail_encryption' => 'required|string|max:100',
        ];
    }

    private function pageValidateArray(): array
    {
        return [
            'page_id' => 'nullable|string|max:100',
        ];
    }

}
