<?php

namespace App\Http\Requests\Front;

use App\Http\Requests\CoreRequest;
use Illuminate\Support\Facades\Config;

class RegisterRequest extends CoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $customRules = [];

        if($this->setting->custom_fields_on_register == 1) {
            $custom = \DB::table('custom_fields')->select('id', 'name', 'required')->get()->toArray();
                $customRules = [];

            foreach ($custom as $item) {
                $customRules['custom_fields_data.'.$item->name.'_'.$item->id] = ($item->required == 'yes') ? 'required' : '';
            }
        }

        $recaptcha = [];

        if($this->setting->recaptcha == 1) {
            Config::set('recaptcha.public_key', $this->setting->recaptcha_public_key);
            Config::set('recaptcha.private_key', $this->setting->recaptcha_private_key);
            $recaptcha['g-recaptcha-response'] = 'required|recaptcha';
        }


        $mainRules = [

            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required_with:password',
            'gender' => 'required'
        ];

        return array_merge($customRules, $mainRules, $recaptcha);
    }

    public function messages()
    {
        $custom = \DB::table('custom_fields')->select('id', 'name', 'required')->get()->toArray();
        $customRules = [];

        foreach ($custom as $item) {
            $customRules['custom_fields_data.'.$item->name.'_'.$item->id.'.required'] = 'The '. $item->name. ' field is required';
        }


        return $customRules;
    }

}
