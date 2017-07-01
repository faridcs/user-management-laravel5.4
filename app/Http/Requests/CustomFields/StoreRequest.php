<?php

namespace App\Http\Requests\CustomFields;

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
        return $user->can('manage-custom-fields');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label'     => 'required|unique:custom_fields',
            'name'      => 'required|unique:custom_fields|alpha_dash',
            'required'  => 'required',
            'type'      => 'required'
        ];
    }

}
