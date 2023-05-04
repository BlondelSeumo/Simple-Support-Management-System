<?php

if (!function_exists('activesetting')) {
    function activesetting($active)
    {
        $settingtype = setting('settingtype') ?? 'generalsetting';

        if ($settingtype == $active) {
            return true;
        }
        return false;
    }
}

if (!function_exists('site_logo')) {
    function site_logo()
    {
        $site_logo = setting('site_logo') ?? 'logo.png';
        return asset('image/'. $site_logo);
    }
}
