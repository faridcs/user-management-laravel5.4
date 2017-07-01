<?php

namespace App\Http\Controllers;

use App\Classes\Reply;
use App\Http\Requests\Settings\IndexRequest;
use App\Http\Requests\Settings\UpdateRequest;
use View;

class SettingController extends UserBaseController
{

    /**
     * Display a listing of the resource.
     * @param IndexRequest $request
     * @return \Illuminate\Contracts\View\View
     */

    public function index(IndexRequest $request)
    {
        $this->pageTitle = trans('menu.social_login');
        return View::make('admin.settings.social_settings', $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @return array
     */
    public function update(UpdateRequest $request)
    {
        $setting = $this->global;

        if ($request->setting == 'general') {
            $setting->site_name = $request->site_name;
            $setting->name      = $request->name;
            $setting->email     = $request->email;

            if ($request->image) {
                $fileName = $this->generateNewFileName($request->image->getClientOriginalName());
                \Storage::put('logo/' . $fileName, fopen($request->image, 'r'), 'public');
                $setting->logo = $fileName;
            }

            $setting->save();

            return Reply::success('messages.updateSuccess');

        } elseif ($request->setting == 'social') {
            $setting->facebook_client_id     = $request->facebook_client_id;
            $setting->facebook_client_secret = $request->facebook_client_secret;
            $setting->google_client_id       = $request->google_client_id;
            $setting->google_client_secret   = $request->google_client_secret;
            $setting->twitter_client_id      = $request->twitter_client_id;
            $setting->twitter_client_secret  = $request->twitter_client_secret;
            $setting->recaptcha_public_key  = $request->recaptcha_public_key;
            $setting->recaptcha_private_key  = $request->recaptcha_private_key;
            $setting->save();

            return Reply::success('messages.updateSuccess');

        } elseif ($request->setting == 'theme') {
            $theme = $request->theme;
            $themeArray = explode(':', $request->theme);

            if(isset($themeArray[1])){
                $theme                      = $themeArray[0];
                $setting->theme_color = $themeArray[1];
            }

            $setting->theme_folder = $theme;
            $setting->save();

            return Reply::redirect(route('theme-settings'), 'Theme successfully changed!');

        } elseif ($request->setting == 'settings') {

            $setting->email_notification       = $request->emailNotification;
            $setting->recaptcha                = $request->recaptcha;
            $setting->remember_me              = $request->rememberMe;
            $setting->forget_password          = $request->forgetPassword;
            $setting->allow_register           = $request->allowRegister;
            $setting->email_confirmation       = $request->emailConfirmation;
            $setting->custom_field_on_register = $request->customOnRegister;
            $setting->save();

            return Reply::success('messages.updateSuccess');

        } elseif ($request->setting == 'mail') {

            $setting->mail_driver     = $request->mailDriver;
            $setting->mail_host       = $request->mailHost;
            $setting->mail_port       = $request->mailPort;
            $setting->mail_username   = $request->mailUsername;
            $setting->mail_password   = $request->mailPassword;
            $setting->mail_encryption = $request->mailEncryption;
            $setting->save();

            return Reply::success('messages.updateSuccess');
        }
    }

    /**
     * Display a listing of the resource.
     * @param IndexRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getGeneralSettings(IndexRequest $request)
    {
        $this->pageTitle = trans('menu.generalSettings');
        return View::make('admin.settings.general_settings', $this->data);
    }

    /**
     * @param IndexRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getSettings(IndexRequest $request)
    {
        $this->pageTitle = trans('menu.settings');
        return View::make('admin.settings.settings', $this->data);
    }

    /**
     * @param IndexRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getMailSettings(IndexRequest $request)
    {
        $this->pageTitle = trans('menu.mailSettings');
        return View::make('admin.settings.mail_setting', $this->data);
    }

    /**
     * Generate a new unique file name
     * @param $currentFileName
     * @return string new file name
     */

    public function generateNewFileName($currentFileName)
    {

        $ext     = strtolower(\File::extension($currentFileName));
        $newName = md5(microtime());

        return $newName . '.' . $ext;
    }

}
