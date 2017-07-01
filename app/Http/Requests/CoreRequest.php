<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\Reply;

class CoreRequest extends FormRequest
{
    protected $setting;

    /**
     * CoreRequest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setting = Setting::first();
    }

    protected function formatErrors(\Illuminate\Contracts\Validation\Validator  $validator)
    {
        return Reply::formErrors($validator);
    }

}