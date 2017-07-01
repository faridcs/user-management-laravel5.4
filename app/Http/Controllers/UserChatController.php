<?php

namespace App\Http\Controllers;

use App\Classes\Reply;
use App\Http\Controllers\UserBaseController;
use App\Http\Requests\Message\IndexRequest;
use App\Http\Requests\Message\StoreRequest;
use App\Models\User;
use App\Models\UserChat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Facades\Datatables;

/**
 * Class UserChatController
 * @package App\Http\Controllers\User
 */
class UserChatController extends UserBaseController
{
     /**
	 * UserController constructor.
	 */

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = trans('core.chatUsers');
    }

    /**
     * @param IndexRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(IndexRequest $request)
    {
        $userID = Input::get('userID');
        $id     = $userID;
        $name   = '';

        if (\Entrust::can('message-to-other-users')) {
            $this->userList = $this->userListLatest();

        } else {
            $this->userList = User::where('user_type', '=', 'admin')->get();
        }

        if(count($this->userList) != 0)
        {
            if(($userID == '' || $userID == null)){
                $id   = $this->userList->first()->id;
                $name = $this->userList->first()->name;

            }else{
                $id = $userID;
                $name = User::find($userID)->name;
            }
        }

        $this->dpData = $id;
        $this->dpName = $name;
        $this->chatDetails = UserChat::where('user_id', $id)
            ->where('admin_id', $this->user->id)
            ->orderBy('created_at', 'asc')->get();

        if (\Request::ajax()) {
            return $this->userChatData($this->chatDetails, 'user');
        }

        return \View::make('admin.users-chat.index', $this->data);
    }

    /**
     * @param $chatDetails
     * @param $type
     * @return string
     */
    public function userChatData($chatDetails, $type)
    {
        $chatMessage = '';

        if(count($chatDetails) > 0)
        {
            UserChat::where('to', $this->user->id)->update(['message_seen' => 'yes']);

            foreach($chatDetails as $chatDetail)
            {

                if ($chatDetail->from == $this->user->id) {
                    $userName  = 'You';
                    $userClass = 'out';
                    $userLTEClass = 'right';
                    $pullClass = 'right';
                    $dateClass = 'left';

                    $userImage = $chatDetail->admin->getGravatarAttribute(30);

                    if($chatDetail->message_seen == 'yes')
                    {
                        $seen = '<span class="message-seen">seen</span>';
                    }
                    else{
                        $seen = '';
                    }
                }
                else
                {
                    $userImage = $chatDetail->user->getGravatarAttribute(30);
                    $userLTEClass = '';
                    $pullClass = 'left';
                    $dateClass = 'right';

                    if($type == 'user'){
                        $userName = $chatDetail->user->name;
                    }
                    else{
                        $userName = $chatDetail->admin->name;
                    }

                    $userClass = 'in';
                    $seen = '';
                }

                if($this->global->theme_folder == 'admin-lte'){
                    $chatMessage .= '<div class="direct-chat-msg '.$userLTEClass.'">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-'.$pullClass.'">' . $userName . '</span>
                                            <span class="direct-chat-timestamp pull-'.$dateClass.'"> ' . $chatDetail->created_at->format('H:i d-m-Y') . ' </span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="'.$userImage.'" alt="Message User Image"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                             ' . $chatDetail->message . '
                                        </div>
                                         '.$seen.'
                                    </div>';
                }
                else if($this->global->theme_folder == 'elite-admin'){
                    $chatMessage .= '<li class="odd">
                                    <div class="chat-image"> <img alt="Female" src="'.$userImage.'"> </div>
                                    <div class="chat-body">
                                        <div class="chat-text">
                                            <h4>' . $userName . '</h4>
                                            <p> ' . $chatDetail->message . ' </p> <b>' . $chatDetail->created_at->format('H:i d-m-Y') . '</b> </div>
                                    </div>
                                </li>';
                }
                else{
                    $chatMessage .= '<li class="' . $userClass . '" id="message_'.$chatDetail->id.'">
                        <img class="avatar" alt="" src="'.$userImage.'" />
                        <div class="message">
                            <span class="arrow">
                            </span>
                            <a href="#" class="name">' . $userName . '</a>
                            <span class="datetime">
                                 at ' . $chatDetail->created_at->format('H:i d-m-Y') . '</span>
                            <span class="body">
                            ' . $chatDetail->message . '
                             </span>
                            '.$seen.'
                        </div>
                    </li>';
                }

            }
        }else{
            $chatMessage .= '<li >
                        <div class="message">
                          No Message Found
                        </div>
                    </li>';
        }

        $chatMessage .= '<li id="scrollHere"></li>';



        return Reply::success('Fetching chat detail', ['chatData' => $chatMessage]);

    }

    /**
     * @param StoreRequest $request
     * @return mixed
     */
    public function postChatMessage(StoreRequest $request)
    {

        $message          = $request->get('message');
        $userID           = $request->get('userID');

        $allocatedModel = new UserChat();
        $allocatedModel->message         = $message;
        $allocatedModel->admin_id        = $this->user->id;
        $allocatedModel->user_id         = $userID;
        $allocatedModel->from            = $this->user->id;
        $allocatedModel->to              = $userID;
        $allocatedModel->save();

        if (\Entrust::can('message-to-other-users')) {
            $userLists = $this->userListLatest();

        } else {
            $userLists = User::where('user_type', '=', 'admin')->get();
        }

        $users = '';

        foreach($userLists as $userList)
        {
            if($userID == $userList->id)
            {
                $userActive = 'active';
            }
            else{
                $userActive = '';
            }

            $userName = "'".$userList->name."'";

            if($this->global->theme_folder == 'admin-lte') {
                $users .= '<li id="dp_'.$userList->id.'">
                                <a href="javascript:;" data-toggle="tooltip" title=""  onclick="getChatData('.$userList->id.', '.$userName.');return false;" >
                                    <img class="contacts-list-img" src="'.$userList->getGravatarAttribute(30).'" alt="User Image" style="width:35px;height:35px;">

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            '.$userList->name.'
                                        </span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>';
            }
            else{
                $users .= '<div class="mt-comment '.$userActive.'" onclick="getChatData('.$userList->id.', '.$userName.')" id="dp_'.$userList->id.'">
                            <div class="mt-comment-img">
                                <img src="'.$userList->getGravatarAttribute(30).'" style="width:35px;height:35px;"/> </div>
                            <div class="mt-comment-body">
                                <div class="mt-comment-info">
                                    <span class="mt-comment-author">'.$userList->name.'</span>
                                    <span class="badge" id="badge_'.$userList->id.'"></span>
                                </div>
                            </div>
                        </div>';
            }

        }

        $indexRequestObj = new IndexRequest();

        return Reply::success('Fetching chat detail', ['chatData' => $this->index($indexRequestObj), 'dataUserID' => $this->user->id, 'userList' => $users]);
    }

    /**
     * @param $chatDetails
     * @return string
     */
    public function userEditorChatData($chatDetails)
    {
        $chatMessage = '';

        if (count($chatDetails) > 0) {
            foreach ($chatDetails as $chatDetail) {

                if ($chatDetail->from == $this->user->id) {
                    $userName  = 'You';
                    $userClass = 'out';

                } else {
                    $userName  = $chatDetail->dataProcessor->username;
                    $userClass = 'in';
                }

                $chatMessage .= '<li class="' . $userClass . '">
                        <div class="message">
                            <span class="arrow">
                            </span>
                            <a href="#" class="name">' . $userName . '</a>
                            <span class="datetime">
                                 at ' . $chatDetail->created_at->format('H:i d-m-Y') . '</span>
                            <span class="body">
                            ' . $chatDetail->message . 'hellosssss

                        </div>
                    </li>';
            }
        } else {
            $chatMessage .= '<li><div class="message"> No Message Found</div></li>';
        }

        return $chatMessage;
    }

    /**
     * @return mixed
     */
    public function userListLatest()
    {
        $result = User::select('users.id', 'users.name', 'users.email', 'users.avatar', 'users.user_type')
                        ->where('user_type', 'user')
                        ->leftJoin(DB::raw('(SELECT * FROM users_chat ORDER BY users_chat.created_at DESC) b'), 'b.to', '=', 'users.id')
                        ->orderBy('b.created_at', 'desc')
                        ->groupBy('users.id')
                        ->where('users.id', '!=', $this->user->id)
                        ->get();
        return $result;
    }

}
