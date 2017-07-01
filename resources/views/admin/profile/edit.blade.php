
@extends('admin.layouts.user')
@section('style')
    <link href="{{ asset('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/pages/css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet bordered">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                <img src="{{ $editUser->gravatar }}" class="img-responsive profile-image" alt=""> </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"> {{ $editUser->name }}</div>
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                        </div>
                    </div>
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                {!!  Form::open(['url' => '','class'=>'form-horizontal' ,'autocomplete'=>'off','enctype' => 'multipart/form-data','id'=>'add-edit-form']) 	 !!}
                                                <input type="hidden" name="_method" value="PUT">
                                                <div class="box-body form">
                                                    <div class="form-body">
                                                        <div class="form-group form-md-line-input">
                                                            <label class="col-sm-2 control-label" for="name">@lang('core.name')</label>

                                                            <div class="col-sm-10">
                                                                <input type="text" name="name" id="name" class="form-control"  placeholder="@lang('core.name')" value="{{$editUser->name or ''}}">
                                                                <div class="form-control-focus"> </div>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="type" value="personalInfo">
                                                        <div class="form-group form-md-line-input">
                                                            <label class="col-sm-2 control-label" for="email">@lang('core.email')</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" name="email" id="email" class="form-control" placeholder="@lang('core.email')" value="{{$editUser->email or ''}}">
                                                                <div class="form-control-focus"> </div>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-md-line-input">
                                                            <label  class="col-sm-2 control-label" for="datepicker">@lang('core.dob')</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control form-control-inline date-picker" size="16" name="dob" id="datepicker" value="{{ isset($editUser->dob)?Carbon\Carbon::parse($editUser->dob)->format('Y-m-d'):Carbon\Carbon::now()->format('Y-m-d')}}">
                                                                <div class="form-control-focus"> </div>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-md-line-input">
                                                            <label  class="col-sm-2 control-label" for="gender">Gender</label>
                                                            <div class="col-sm-10">
                                                                {!! Form::select('gender',['male'=>'Male','female'=>'Female'],isset($editUser)?$editUser->gender:'',['class' => 'form-control gender']) !!}
                                                                <div class="form-control-focus"> </div>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>

                                                        @foreach($fields as $field)
                                                            <div class="form-group form-md-line-input">
                                                                <label  class="col-sm-2 control-label">{{$field->label}}</label>
                                                                <div class="col-sm-10">
                                                                    @if( $field->type == 'text')
                                                                        <input type="text" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" placeholder="{{$field->label}}" value="{{$editUser->custom_fields_data['field_'.$field->id] or ''}}">
                                                                    @elseif($field->type == 'password')
                                                                        <input type="password" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" placeholder="{{$field->label}}" value="{{$editUser->custom_fields_data['field_'.$field->id] or ''}}">
                                                                    @elseif($field->type == 'number')
                                                                        <input type="number" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" placeholder="{{$field->label}}" value="{{$editUser->custom_fields_data['field_'.$field->id] or ''}}">

                                                                    @elseif($field->type == 'textarea')
                                                                        <textarea name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" id="{{$field->name}}" cols="3">{{$editUser->custom_fields_data['field_'.$field->id] or ''}}</textarea>

                                                                    @elseif($field->type == 'radio')
                                                                        <div class="md-radio-list">

                                                                            @foreach($field->values as $key=>$value)
                                                                                <div class="md-radio">
                                                                                    <input type="radio" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" id="optionsRadios{{$key.$field->id}}" class="md-radio" value="{{$value}}"
                                                                                           @if(isset($editUser) && $editUser->custom_fields_data['field_'.$field->id] == $value) checked @elseif($key==0) checked @endif>
                                                                                    <label for="optionsRadios{{$key.$field->id}}">
                                                                                        <span></span>
                                                                                        <span class="check"></span>
                                                                                        <span class="box"></span> {{$value}}
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @elseif($field->type == 'select')
                                                                        {!! Form::select($field->name,
                                                                                $field->values,
                                                                                 isset($editUser)?$editUser->custom_fields_data['field_'.$field->id]:'',['class' => 'form-control gender'])
                                                                         !!}

                                                                    @elseif($field->type == 'checkbox')
                                                                        <div class="mt-checkbox-inline">
                                                                            @foreach($field->values as $key => $value)
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input name="custom_fields_data[{{$field->name.'_'.$field->id}}][]" type="checkbox" value="{{$key}}"> {{$value}}
                                                                                    <span></span>
                                                                                </label>
                                                                            @endforeach
                                                                        </div>
                                                                    @elseif($field->type == 'date')
                                                                        <input type="text" class="form-control form-control-inline date-picker" size="16" name="custom_fields_data[{{$field->name.'_'.$field->id}}]"
                                                                               id="datepicker" value="{{ isset($editUser->dob)?Carbon\Carbon::parse($editUser->dob)->format('Y-m-d'):Carbon\Carbon::now()->format('Y-m-d')}}"
                                                                    @endif
                                                                    <div class="form-control-focus"> </div>
                                                                    <span class="help-block"></span>

                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn  dark " data-dismiss="modal" aria-hidden="true">Close</button>
                                                    <button id="save" type="submit" class="btn  green" onclick="editProfile({{$editUser->id or ''}});return false">Submit</button>
                                                </div>
                                                {{Form::close()}}
                                            </div>
                                            <!-- END PERSONAL INFO TAB -->
                                            <!-- CHANGE AVATAR TAB -->
                                            <div class="tab-pane" id="tab_1_2">
                                                {!!  Form::open(['url' => '','class'=>'' ,'autocomplete'=>'off','enctype' => 'multipart/form-data','id'=>'updateImage']) 	 !!}
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <div class="form-group form-md-line-input">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="{{ $editUser->gravatar }}" alt=""/> </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                            <div>
                                                                        <span class="btn green btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="file" name="image"> </span>
                                                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id" value=""/>
                                                        <div class="clearfix margin-top-10">
                                                            <span class="label label-danger">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead. </div>

                                                    </div>
                                                    <input type="hidden" name="type" value="avatar">
                                                    <div class="margin-top-10">
                                                        <button type="submit" class="btn green" onclick="updateImage({{$editUser->id}});return false"> Submit </button>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                            <!-- END CHANGE AVATAR TAB -->
                                            <!-- CHANGE PASSWORD TAB -->
                                            <div class="tab-pane" id="tab_1_3">
                                                {!!  Form::open(['url' => '','class'=>'' ,'autocomplete'=>'off','id'=>'changePassword']) 	 !!}

                                                    <div class="form-group form-md-line-input">
                                                        <input type="hidden" name="id" value=""/>
                                                        <input type="password" class="form-control" name="password" id="password"/>
                                                        <label class="control-label">New Password</label>
                                                        <span class="form-control-focus"> </span>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"/>
                                                        <label class="control-label">Re-type New Password</label>
                                                        <span class="form-control-focus"> </span>
                                                    </div>
                                                    <input type="hidden" name="type" value="password">
                                                    <div class="margin-top-10">
                                                        <button type="submit" class="btn green" onclick="changePassword({{$editUser->id}});return false;"> Change Password </button>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                            <!-- END CHANGE PASSWORD TAB -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection

@section('scripts-footer')
{{--global/plugins/bootstrap-fileinput/bootstrap-fileinput.js--}}
<script src="{{ asset('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<script>
    $('.date-picker').datepicker({
        format: 'yyyy-mm-dd'
    });

    // Edit profile
    function editProfile(id) {
        var url  ="{{route('profile.update',':id')}}"
        url      = url.replace(':id',id);
        $.easyAjax({
            type: "POST",
            url: url,
            container: "#add-edit-form",
            data: $("#add-edit-form").serialize()
        });
    }

    // Update profile image
    function updateImage(id) {
        var url  ="{{route('profile.update',':id')}}";
        url      = url.replace(':id',id);
        var path = '{{asset('avatar').'/'}}';
        $.easyAjax({
            type: "POST",
            url: url,
            container: "#updateImage",
            file:true,
            success:function (response) {
                if("imageName" in response){
                    $('.profile-image').attr('src',path + response.imageName);
                }
            }
        });
    }

    // Change password
    function changePassword(id) {
        var url  ="{{route('profile.update',':id')}}";
        url      = url.replace(':id',id);
        $.easyAjax({
            type: "put",
            url: url,
            container: "#changePassword",
            data: $("#changePassword").serialize()
        });
    }
</script>

@endsection