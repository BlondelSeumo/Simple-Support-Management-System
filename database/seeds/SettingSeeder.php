<?php

use Illuminate\Database\Seeder;
use Setting as SeederSetting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settingArray['site_name']    = 'Green Support';
        $settingArray['email']        = 'admin@example.com';
        $settingArray['phone']        = '00458716574';
        $settingArray['copyright_by'] = 'This site was developed  Green Soft BD';
        $settingArray['site_logo']    = 'logo.png';
        $settingArray['address']      = 'Mirpur, Dhaka';
        $settingArray['timezone']     = 'Asia/Dhaka';
        $settingArray['google_map']     = '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7302.120261618787!2d90.358631!3d23.780873!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0be89363e87%3A0x3795036c15355c82!2sKallyanpur%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1635609041664!5m2!1sen!2sbd" allowfullscreen="" loading="lazy"></iframe>';

        $settingArray['mail_host']         = '';
        $settingArray['mail_port']         = '';
        $settingArray['mail_username']     = '';
        $settingArray['mail_password']     = '';
        $settingArray['mail_from_address'] = '';

        $settingArray['page_id'] = '121827448405190';

        SeederSetting::set($settingArray);
        SeederSetting::save();
    }
}
