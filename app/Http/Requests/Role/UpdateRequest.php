<?php

namespace App\Http\Requests\Role;

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
        return $user->can('edit-role');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|unique:roles,name,' . $this->route('role'),
            'display_name'  => 'required|unique:roles,display_name,' . $this->route('role'),
            'permission'    => 'required'
        ];
    }

}
