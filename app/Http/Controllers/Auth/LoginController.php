<?php

namespace App\Http\Controllers\Auth;

use App\Classes\Reply;
use App\Http\Controllers\UserBaseController;
use App\Http\Requests;
use App\Http\Requests\Front\ChangePasswordRequest;
use App\Http\Requests\Front\ForgetPasswordRequest;
use App\Http\Requests\Front\LoginRequest;
use App\Http\Requests\Front\RegisterRequest;
use App\Models\EmailTemplate;
use App\Models\Setting;
use App\Models\Social;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Log;
use Mail;

class LoginController extends UserBaseController
{

     /**
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */

    public function index()
    {
        $this->pageTitle = trans('core.login');
        // If a user is already logged in, log him out
        if(\Auth::check()) {
            return \Redirect::route('user.dashboard.index');
        }

        return \View::make('admin.login', $this->data);
    }

     /**
	 * @param Requests\LoginRequest $request
	 * @return array
	 */

    public function ajaxLogin(LoginRequest $request)
    {
        $email      = $request->get('email');
        $password   = $request->get('password');

        // Credentials to check user login
        $credentials = array('email' => $email, 'password' => $password);
        $remember    = $request->remember ? true : false;


        if (\Auth::attempt($credentials, $remember)) {
            // User login success
            return Reply::redirect(route('user.dashboard.index'), 'messages.loginSuccess');

        }


        // Login Failed
        return Reply::error('messages.loginFail');
    }

    public function redirect($provider)
    {
        $this->setServicesProvider($provider);
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $this->setServicesProvider($provider);

        $data = Socialite::driver($provider)->user();

        $information = [
            'name'             => $data->name,
            'email'            => $data->email,
        ];

        $user = User::where('email', '=', $data->email)->first();

        if ($user === null) {
            // Log in first time with social

            \DB::beginTransaction();

            $userData = User::create($information);

            Social::create([
                'user_id' => $userData->id,
                'social_id' => $data->id,
                'social_service' => $provider,
            ]);

            \DB::commit();

            \Auth::login($userData);

            return Redirect::route('user.dashboard.index');
        }
        else {

            // User found
            \DB::beginTransaction();

            Social::where('user_id', '=', $user->id)
                ->update([
                    'social_id' => $data->id,
                    'social_service' => $provider,
                ]);

            \DB::commit();

            \Auth::login($user);

            return Redirect::route('user.dashboard.index');
        }
    }

    /**
     * @param $provider
     */
    public function setServicesProvider($provider)
    {
        $providerClientId = $provider.'_client_id';
        $providerSecretKey = $provider.'_client_secret';

        Config::set('services.'.$provider.'.client_id', $this->global->$providerClientId);
        Config::set('services.'.$provider.'.client_secret', $this->global->$providerSecretKey);
        Config::set('services.'.$provider.'.redirect', 'http://localhost:8000/callback/'.$provider);
    }

    /**
     * @return  view
     */
    public function getRegister()
    {
        $this->pageTitle = trans('core.register');
        $user = new User();
        $this->fields = $user->getCustomFieldGroupsWithFields()->fields;

        return \View::make($this->global->theme_folder . '.register', $this->data);
    }

    /**
     * @param RegisterRequest $request
     * @return array
     */
    public function postRegister(RegisterRequest $request)
    {
        \DB::beginTransaction();

        $user           = new User();
        $user->name     = $request->get('name');
        $user->email    = $request->get('email');
        $user->dob      = Carbon::parse($request->get('dob'))->format('Y-m-d');
        $user->gender   = $request->get('gender');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        // To add custom fields data
        if($request->get('custom_fields_data')){
            $user->updateCustomFieldData($request->get('custom_fields_data'));
        }

        \DB::commit();

        if($this->global->email_notification == 1)
        {
            $emailInfo = [
                'to'     => $user->email,
                'toName' => $user->name,
            ];

            $fieldValues = [
                'USERNAME' => $user->name,
                'URL'      => '<a style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #00c0c8; border-radius: 60px; text-decoration:none;" href="' . route('user.login') . '">Login</a>',
            ];

            EmailTemplate::prepareAndSendEmail('USER_REGISTRATION', $emailInfo, $fieldValues);
        }

        $msg = trans('messages.signUpSuccess', ['here' => '<a href="' . route('user.login') . '">Here</a>']);

        return Reply::success($msg);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function getReset ()
    {
        $this->pageTitle = trans('core.resetPassword');
        return \View::make('admin.forget', $this->data);
    }

    public function postReset(ForgetPasswordRequest $request)
    {

        $email = $request->email;
        $user  = User::where('email', $email)->first();

        $passwordResetCode = str_random(40);
        $user->reset_token = $passwordResetCode;
        $user->save();

        if($this->global->email_notification == 1)
        {
            $emailInfo = [
                'to'     => $user->email,
                'toName' => $user->name,
            ];

            $fieldValues = [
                'USERNAME' => $user->name,
                'URL'      => '<a style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #00c0c8; border-radius: 60px; text-decoration:none;" href="'.route('get-password-reset') . '?password-reset-code=' . $passwordResetCode.'">RESET PASSWORD</a>'
            ];

            EmailTemplate::prepareAndSendEmail('FORGET_PASSWORD', $emailInfo, $fieldValues);
        }

        $msg = trans('messages.resetPasswordLink', ['here' => '<a href="' . route('user.login') . '">Here</a>']);

        return Reply::success($msg);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function getPasswordReset()
    {
        $this->pageTitle = trans('core.resetPassword');
        $this->passwordResetCode = Input::get('password-reset-code');
        return \View::make($this->global->theme_folder . '.update-reset-password', $this->data);
    }

    /**
     * Post Password Reset
     * @param Requests\Front\ChangePasswordRequest $request
     * @return array
     */
    public function postPasswordReset(ChangePasswordRequest $request)
    {
        $passwordResetCode = $request->passwordResetCode;

        $user = User::where('reset_token', $passwordResetCode)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        if($this->global->email_notification == 1)
        {
            $emailInfo = [
                'to'     => $user->email,
                'toName' => $user->name,
            ];

            $fieldValues = [
                'USERNAME' => $user->name,
                'URL'      => '<a style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #00c0c8; border-radius: 60px; text-decoration:none;" href="'.route('get-password-reset') . '?password-reset-code=' . $passwordResetCode.'">RESET PASSWORD</a>'
            ];

            EmailTemplate::prepareAndSendEmail('RESET_SUCCESS', $emailInfo, $fieldValues);
        }

        $msg = trans('messages.changePasswordSuccess', ['here' => '<a href="' . route('user.login') . '">Here</a>']);

        return Reply::success($msg);
    }

     /**
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function logout()
    {
         \Auth::logout();
         return \Redirect::route('user.login');
    }

}
