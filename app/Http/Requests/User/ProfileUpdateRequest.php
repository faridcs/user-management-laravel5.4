<?php

namespace App\Http\Requests\User;

use App\Http\Requests\CoreRequest;

class ProfileUpdateRequest extends CoreRequest
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
        if($this->get('type') == 'personalInfo') {
            return [
                'email' => 'required|unique:users,email,'.$this->route('profile'),
                'name'  => 'required',
            ];

        } elseif ($this->get('type') == 'avatar') {
            return [

            ];

        } elseif ($this->get('type') == 'password') {
            return [
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ];
        }


    }

}
