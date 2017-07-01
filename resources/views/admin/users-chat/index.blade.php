@extends('admin.layouts.user')
@section('style')
    <link href="{{ asset('admin/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />

    <style>
            .btn-edit {
                background-color: unset;
                border: none;
            }

            .chat-form .btn-cont .arrow {
                left: -2px;
                border-right: 8px solid #3598dc!important;
            }

            .chat-form .btn-cont:hover .arrow{
                border-right-color: #0362fd!important;
            }
            .chat-form .btn-cont {
                left: -13px;
                top: -1px;
            }
    </style>

@endsection
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-users"></i>
                                    <span class="caption-subject bold uppercase"> @lang('menu.userChat') </span>
                                </div>
                                <div class="actions">
                                </div>
                            </div>
                            <div class="portlet-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="portlet light bordered">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption">
                                                <i class="icon-bubbles font-dark hide"></i>
                                                <span class="caption-subject font-dark bold uppercase">Users</span>
                                            </div>

                                        </div>
                                        <div class="portlet-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="portlet_comments_1">
                                                    <!-- BEGIN: User list -->
                                                    <div class="mt-comments userList">
                                                        @forelse($userList as $users)
                                                        <div class="mt-comment" onclick="getChatData({{$users->id}}, '{{$users->name}}')" id="dp_{{$users->id}}">
                                                            <div class="mt-comment-img">
                                                                <img src="{{$users->getGravatarAttribute(30)}}" style="height: 35px; width: 35px;"/> </div>
                                                            <div class="mt-comment-body">
                                                                <div class="mt-comment-info">
                                                                    <span class="mt-comment-author">{{$users->name}}</span>
                                                                    <span class="badge" id="badge_{{$users->id}}"></span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        @empty
                                                            <div class="mt-comment">
                                                                <div class="mt-comment-body">
                                                                   No user Found
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                    <!-- END:  User list  -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bubble font-hide hide"></i>
                                                <span class="caption-subject font-hide bold uppercase dpName">{{$dpName}}</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body" id="chats">
                                            <div class="scroller" style="height: 525px;" data-always-visible="1" data-rail-visible1="1">
                                                <ul class="chats">

                                                </ul>
                                            </div>
                                            <div class="chat-form">
                                                {!! Form::open(['url' => '' ,'method' => 'post',]) !!}
                                                    <div class="input-cont">
                                                        <input class="form-control" id="submitTexts" name="message" type="text" placeholder="Type a message here..."/>
                                                        <input  id="dpID" value="{{$dpData}}"  type="hidden"  />
                                                        <input  id="dpName" value="{{$dpName}}"  type="hidden"  />

                                                    </div>
                                                    <button id="submitBtn" class="btn-cont btn-edit " type="submit">
                                                    <span class="arrow">
                                                    </span>
                                                        <a href="" class="btn blue icn-only">
                                                            <i class="fa fa-check icon-white"></i>
                                                        </a>
                                                </button>
                                                {!! Form::close() !!}
                                            </div>
                                            </br>
                                            <div id="errorMessage"></div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>
                            </div>

                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </section>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>

    <div id="addEditModal" class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {{--Content to inserted by ajax data--}}
            </div>
        </div>
    </div>

    @include('admin.include.delete-modal')
@endsection

@section('scripts-footer')

    <script>

        var dpButtonID = "";
        var dpName     = "";

        var dpClassID = '{{$dpData}}';

        if(dpClassID){ $('#dp_'+dpClassID).addClass('mt-comment active');}

        //getting data
        getChatData(dpButtonID , dpName);

        //submitting message
        $('#submitBtn').on('click', function(e)
        {
            e.preventDefault();
            //getting values by input fields
            var submitText = $('#submitTexts').val();
            var dpID       = $('#dpID').val();
            //checking fields blank
            if(submitText == "" || submitText == undefined || submitText == null){
                $('#errorMessage').html('<div class="alert alert-danger"><p>Message field cannot be blank</p></div>');
            }else{

                var url = "{{ route('user-chat.message-submit') }}";
                var token = "{{ csrf_token() }}";
                $.easyAjax({
                    type: 'POST',
                    url: url,
                    messagePosition: '',
                    data:  {'message':submitText,'userID':dpID,'_token': token},
                    container: ".chat-form",
                    blockUI: true,
                    redirect: false,
                    success: function (response) {
                        var blank = "";
                        $('#submitTexts').val('');

                        //getting values by input fields
                        var dpID   = $('#dpID').val();
                        var dpName = $('#dpName').val();

                        if(dpID){$('#dp_'+dpID).addClass('mt-comment active'); }

                        //set chat data
                        getChatData(dpID, dpName);

                        //set user list
                        $('.userList').html(response.userList);
                    }
                });
            }

            return false;
        });

        //getting all chat data according to user
        function getChatData(id,dpName){
            var getID ='';
            $('#errorMessage').html('');
            if(id != "" && id != undefined && id != null)
            {
                //remove active and set active
                if(dpClassID)
                {
                    $('#dp_'+dpClassID).removeClass('mt-comment active');
                    $('#dp_'+dpClassID).addClass('mt-comment');
                }
                dpClassID = id;

                $('#dp_'+id).addClass('mt-comment active');
                $('#dpID').val(id);
                $('#dpName').val(dpName);
                $('.dpName').html(dpName);
                getID = id;

            }else{getID = $('#dpID').val();}

            var url = "{{ route('user-chat') }}";

            $.easyAjax({
                type: 'GET',
                url: url,
                messagePosition: '',
                data:  {'userID':getID},
                container: ".chats",
                success: function (response) {
                    //set messages in box
                    $('.chats').html(response.chatData);
                    $('.chats').animate({
                        scrollTop: $('.chats li:last-child').position().top
                    }, 'slow');
                }
            });
        }

    </script>
@endsection