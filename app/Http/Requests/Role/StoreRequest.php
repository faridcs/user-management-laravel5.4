<?php

    namespace App\Http\Requests\Role;

use App\Http\Requests\CoreRequest;

class StoreRequest extends CoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        $user = $this->user();
        return $user->can('add-role');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'name'         => 'required|unique:roles',
            'display_name' => 'required|unique:roles',
            'permission'    => 'required'
        ];
    }

    public function messages()
    {
        return [
            'permission.required' => 'Select atleast one permission'
        ];

    }

}
