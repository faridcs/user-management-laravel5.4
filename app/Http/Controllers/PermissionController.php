<?php

namespace App\Http\Controllers;

use App\Classes\Reply;
use App\Http\Requests\Permission\DeleteRequest;
use App\Http\Requests\Permission\IndexRequest;
use App\Http\Requests\Permission\PermissionDeleteRequest;
use App\Http\Requests\Permission\PermissionStoreRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use App\Http\Requests\Permission\StoreRequest;
use App\Http\Requests\Permission\UpdateRequest;
use App\Permission;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Controllers\UserBaseController;

class PermissionController extends UserBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return \Illuminate\Http\Response
     */

    public function index(IndexRequest $request)
    {
        $this->pageTitle = trans('menu.permissions');
        return \View::make('admin.permission.index', $this->data);
    }

    /**
     * @return mixed
     */
    public function getPermissions()
    {
        $permissions = Permission::select('id', 'name', 'display_name', 'description');
        $data = Datatables::of($permissions)
            ->addColumn(
                'action',
                function($row) {
                    // Edit Button
                    $class = $this->global->theme_folder == 'admin-lte' ? 'bg-' : '';
                    $string = '<a style="margin: 1px;" href="javascript:;" onclick="editModal('.$row->id.')" class="btn  btn-info margin-top-10 btn-sm  '.$class.'purple"><i class="fa fa-edit"></i> Edit</a> ';
                    // Delete Button
                    $string .= '<a style="margin: 1px;" href="javascript:;" onclick="deleteAlert('.$row->id.',\''.addslashes($row->name).'\')"  class="btn btn-danger margin-top-10 btn-sm  '.$class.'red"><i class="fa fa-trash"></i> Delete</a>';
                    return $string;
                }
            )
            ->make(true);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $this->icon = 'plus';
        return \View::make('admin.permission.create-edit', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        \DB::beginTransaction();

        $permission = new Permission();
        $permission->name  = $request->get('name');
        $permission->display_name = $request->get('display_name');
        $permission->description   = $request->get('description');
        $permission->save();

        \DB::commit();
        return Reply::success('messages.roleCreateSuccess');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->icon = 'pencil';
        $this->permissions = Permission::find($id);
        return \View::make('admin.permission.create-edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $permissions = Permission::find($id);
        $permissions->name  = $request->get('name');
        $permissions->display_name = $request->get('display_name');
        $permissions->description   = $request->get('description');
        $permissions->save();

        return Reply::success('messages.permissionUpdateSuccess');
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        Permission::whereId($id)->delete();

        return Reply::success('messages.deleteSuccess');
    }

}
