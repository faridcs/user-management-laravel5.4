<?php

namespace App\Http\Requests\Settings;

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

        if($this->get('setting') == 'general') {
            return $user->can('update-general-settings');
        }
        elseif ($this->get('setting') == 'theme') {
            return $user->can('update-theme-settings');
        }
        elseif ($this->get('setting') == 'social') {
            return $user->can('update-social-settings');
        }
        elseif ($this->get('setting') == 'settings') {
            return $user->can('update-common-settings');
        }
        elseif ($this->get('setting') == 'mail') {
            return $user->can('update-mail-settings');
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->get('setting') == 'general') {
            return [
                'site_name'         => 'required',
                'image'        => 'image'
            ];
        }
        elseif ($this->get('setting') == 'theme') {
            return [
                'theme'         => 'required'
            ];
        }
        elseif ($this->get('setting') == 'social') {
            return [
                // Provide rules here
            ];
        }
        elseif ($this->get('setting') == 'settings') {
            return [
                // Provide rules here
            ];
        }
        elseif ($this->get('setting') == 'mail') {
            return [
                // Provide rules here
            ];
        }
    }

}
