<?php

namespace App\Http\Requests\Permission;

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
        return $user->can('edit-permission');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'name'         => 'required|unique:permissions,name,' . $this->route('permission'),
            'display_name' => 'required|unique:permissions,display_name,' . $this->route('permission'),
            'description'  => 'required'
        ];
    }

}
