<?php

namespace App\Observers;

use App\Role;

class RoleObserver
{
    /**
     * Listen to the Role created event.
     *
     * @param  Role  $role
     * @return void
     */

    public function __construct()
    {
        if (\Auth::check()){
            $this->role = \Auth::user()->name;

        }else{
            $this->role = 'Seeder';
        }

    }

    public function created(Role $role)
    {
        activity()
            ->performedOn($role)
            ->causedBy($role)
            ->performedOn($role)
            ->log($this->role.' created role <b>:subject.name</b> successfully');
    }

    /**
     * Listen to the Role deleting event.
     *
     * @param  Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        activity()
            ->performedOn($role)
            ->causedBy($role)
            ->performedOn($role)
            ->log($this->role.' deleted role <b>:subject.name</b> deleted successfully');
    }

    /**
     * @param Role $role
     */

    public function updated(Role $role)
    {
        activity()
            ->performedOn($role)
            ->causedBy($role)
            ->performedOn($role)
            ->log($this->role.' updated role <b>:subject.name</b> successfully');
    }
}