<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * UserObserver constructor.
     */
    public function __construct()
    {
        if (\Auth::check()){
            $this->user = \Auth::user()->name;

        }else{
            $this->user = 'Seeder';
        }

    }

    public function created(User $user)
    {
        activity()
            ->performedOn($user)
            ->causedBy($user)
            ->performedOn($user)
            ->log($this->user.' created user <b>:subject.name</b> successfully');
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        activity()
            ->performedOn($user)
            ->causedBy($user)
            ->performedOn($user)
            ->log($this->user.' deleted user <b>:subject.name</b> deleted successfully');
    }

    /**
     * @param User $user
     */

    public function updated(User $user)
    {
        activity()
            ->performedOn($user)
            ->causedBy($user)
            ->performedOn($user)
            ->log($this->user.' updated user <b>:subject.name</b> successfully');
    }
}