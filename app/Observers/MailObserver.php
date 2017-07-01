<?php

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class MailObserver
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
            $this->mail = \Auth::user()->name;

        }else{
            $this->mail = 'Seeder';
        }

    }

    public function updated(Setting $setting)
    {
        activity()
            ->performedOn($setting)
            ->causedBy($setting)
            ->performedOn($setting)
            ->log($this->mail.' updated mail settings successfully');
    }
}