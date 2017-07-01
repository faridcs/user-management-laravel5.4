<?php

namespace App\Http\Requests\CustomFields;

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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label'     => 'required|unique:custom_fields,label,'.$this->route('custom_field'),
            'name'      => 'required|unique:custom_fields,name,'.$this->route('custom_field'),
            'required'  => 'required',
            'type'      => 'required'
        ];
    }

}
