<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\IndexRequest;
use App\Models\User;
use App\Permission;
use App\Role;
use View;

class DashboardController extends UserBaseController
{

     /**
	 * UserDashboardController constructor.
	 */
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = trans('menu.dashboard');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->activeUsers   = User::getCount('active');
        $this->inActiveUsers = User::getCount('inactive');
        $this->totalUsers    = User::getCount();
        $this->rolesCount    = Role::getCount();
        $this->permissionCount    = Permission::getCount();

        return View::make('admin.dashboard', $this->data);
    }
    
}
