<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class UserBaseController extends Controller
{

    /** @var array */
    public $data = [];

    /**
	 * @param $name
	 * @param $value
	 */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

     /**
	 * @param $name
	 * @return mixed
	 */
    public function __get($name)
    {
        return $this->data[$name];
    }

     /**
	 * @param $name
	 * @return bool
	 */
    public function __isset($name)
    {
        return isset($this->data[ $name ]);
    }

    /**
     * UserBaseController constructor.
     */
    public function __construct()
    {
        // Inject currently logged in user object into every view of user dashboard
        $this->global      = Setting::first();
        $this->projectName = $this->global->site_name;

        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });


    }

}
