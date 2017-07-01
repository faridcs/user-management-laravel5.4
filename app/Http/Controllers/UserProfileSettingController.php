<?php

namespace App\Http\Controllers;

use App\Classes\Reply;
use App\Http\Requests\User\ProfileUpdateRequest;
use App\Models\User;
use App\Http\Requests\User\UserUpdateRequest;
use Auth;
use DB;
use Hash;
use Storage;
use View;

class UserProfileSettingController extends UserBaseController
{

     /**
	 * UserProfileSettingController constructor.
	 */
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = trans('menu.profile');
        $user = new User();
        $this->fields = $user->getCustomFieldGroupsWithFields()->fields;
    }

     /**
	 * @param $id
	 * @return \Illuminate\Contracts\View\View
	 */
    public function edit($id)
    {
        $this->user  = User::find($id);
        $this->editUser = User::find($id)->withCustomFields();
        return View::make('admin.profile.edit', $this->data);
    }

    public function editProfile()
    {
        $this->editUser = User::whereId(Auth::user()->id)->first();

        return View::make('admin.profile.edit', $this->data);
    }

    /**
     * @param ProfileUpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        $user = $this->user;
        $image = [];

        if($id == $user->id) {
            if($request->type == 'personalInfo') {
                $user->name     = $request->get('name');
                $user->email    = $request->get('email');
                $user->gender    = $request->get('gender');
                $user->dob    = $request->get('dob');
                $user->save();

                if($request->get('custom_fields_data')){
                    $user = User::find('1');
                    // To add custom fields data
                    $user->updateCustomFieldData($request->get('custom_fields_data'));
                }

            } elseif ($request->type == 'avatar') {
                if ($request->image) {
                    $fileName = $this->generateNewFileName($request->image->getClientOriginalName());
                    Storage::put('avatar/' . $fileName, fopen($request->image, 'r'), 'public');
                    $user->avatar = $fileName;
                    $user->save();

                    $image = ['imageName' => $user->avatar];

                }

            } elseif ($request->type == 'password') {
                if($request->password){
                    $user->password = Hash::make($request->password);
                    $user->save();
                }
            }


        }

        DB::commit();
        return Reply::success('messages.updateSuccess', $image);

    }

    public function generateNewFileName($currentFileName)
    {

        $ext     = strtolower(\File::extension($currentFileName));
        $newName = md5(microtime());

        return $newName . '.' . $ext;
    }

}
