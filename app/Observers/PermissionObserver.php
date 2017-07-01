<?php

namespace App\Observers;

use App\Permission;

class PermissionObserver
{
    /**
     * Listen to the Permission created event.
     *
     */

    public function __construct()
    {
        if (\Auth::check()){
            $this->permission = \Auth::user()->name;

        }else{
            $this->permission = 'Seeder';
        }

    }

    public function created(Permission $permission)
    {
        activity()
            ->performedOn($permission)
            ->causedBy($permission)
            ->performedOn($permission)
            ->log($this->permission.' created permission <b>:subject.name</b> successfully');
    }

    /**
     * Listen to the Permission deleting event.
     *
     * @param  Permission  $permission
     * @return void
     */
    public function deleted(Permission $permission)
    {
        activity()
            ->performedOn($permission)
            ->causedBy($permission)
            ->performedOn($permission)
            ->log($this->permission.' deleted permission <b>:subject.name</b> deleted successfully');
    }

    /**
     * @param Permission $permission
     */

    public function updated(Permission $permission)
    {
        activity()
            ->performedOn($permission)
            ->causedBy($permission)
            ->performedOn($permission)
            ->log($this->permission.' updated permission <b>:subject.name</b> successfully');
    }
}