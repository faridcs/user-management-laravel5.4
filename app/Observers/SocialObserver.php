<?php

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SocialObserver
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
            $this->social = \Auth::user()->name;

        }else{
            $this->social = 'Seeder';
        }

    }

    public function updated(Setting $setting)
    {
        activity()
            ->performedOn($setting)
            ->causedBy($setting)
            ->performedOn($setting)
            ->log($this->social.' updated social settings successfully');
    }
}