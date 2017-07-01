<?php

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class ThemeObserver
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
            $this->theme = \Auth::user()->name;

        }else{
            $this->theme = 'Seeder';
        }

    }

    public function updated(Setting $setting)
    {
        activity()
            ->performedOn($setting)
            ->causedBy($setting)
            ->performedOn($setting)
            ->log($this->theme.' updated theme settings successfully');
    }
}