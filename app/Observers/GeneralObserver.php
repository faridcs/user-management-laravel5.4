<?php

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class GeneralObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */

    public function __construct()
    {
        if (\Auth::check()){
            $this->general = \Auth::user()->name;

        }else{
            $this->general = 'Seeder';
        }

    }

    public function updated(Setting $setting)
    {
        activity()
            ->performedOn($setting)
            ->causedBy($setting)
            ->performedOn($setting)
            ->log($this->general.' updated general settings successfully');
    }
}