<?php

namespace App\Http\Requests\User;

use App\Http\Requests\CoreRequest;

class UpdateRequest extends CoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        $user = $this->user();
        return $user->can('edit-user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $custom = \DB::table('custom_fields')->select('id', 'name', 'required')->get()->toArray();
        $customRules = [];

        foreach ($custom as $item) {
            $customRules['custom_fields_data.'.$item->name.'_'.$item->id] = ($item->required == 'yes') ? 'required' : '';
        }

        $mainRules = [
            'email' => 'required|unique:users,email,'.$this->route('user'),
            'name'  => 'required',
            'image' => 'image'
        ];

        return array_merge($customRules, $mainRules);
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
