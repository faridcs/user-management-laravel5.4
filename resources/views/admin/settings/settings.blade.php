@extends('admin.layouts.user')

@section('style')
    <link href="{{ asset('admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
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
                                <i class="fa fa-gears"></i>
                                <span class="caption-subject bold uppercase"> @lang('menu.settings') </span>
                            </div>
                            <div class="actions">
                            </div>
                        </div>
                        <div class="portlet-body form">
                            {!! Form::open(['url' => '', 'method' => 'post', 'id' => 'settings-form', 'class' => 'form-horizontal']) !!}
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="control-label col-md-3">@lang('core.emailNotification')</label>
                                    <div class="col-md-9">
                                        <input type="checkbox"  @if($global->email_notification == 1) checked @endif class="make-switch" data-size="normal" name="emailNotification" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">@lang('core.recaptcha')</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" @if($global->recaptcha == 1) checked @endif class="make-switch" data-size="normal" name="recaptcha" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">@lang('core.rememberMe')</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" @if($global->remember_me == 1) checked @endif class="make-switch" data-size="normal" name="rememberMe" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">@lang('core.forgetPassword')</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" @if($global->forget_password == 1) checked @endif class="make-switch" data-size="normal"  name="forgetPassword" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">@lang('core.allowRegister')</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" @if($global->allow_register == 1) checked @endif class="make-switch" data-size="normal"  name="allowRegister" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">@lang('core.emailConfirmation')</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" @if($global->email_confirmation == 1) checked @endif class="make-switch" data-size="normal"  name="emailConfirmation" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">@lang('core.customFieldOnRegister')</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" @if($global->custom_field_on_register == 1) checked @endif class="make-switch" data-size="normal"  name="customOnRegister" value="1">
                                    </div>
                                </div>

                                <input type="hidden" name="setting" value="settings">
                                {{--<div class="form-group form-md-line-input">--}}
                                    {{--<input name = "email_notification" type="text" class="form-control"  value = "{{$global->email_notification or ''}}">--}}
                                    {{--<label for="form_control_1">Email Notification</label>--}}
                                {{--</div>--}}
                                <div class="form-actions noborder">
                                    <button type="button" class="btn  blue" onclick="addEditSettings({{$global->id}})">Submit</button>

                                </div>
                            </div>
                            {!! Form::close()!!}
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
@endsection

@section('footerjs')
    <script src="{{ asset('admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
@endsection

@section('scripts-footer')
<script>
    function addEditSettings(id) {
        var url = "{{route('settings.update',':id')}}";
        url = url.replace(':id',id);
        $.easyAjax({
            type: 'PUT',
            url: url,
            data: $('#settings-form').serialize(),
            container: "#settings-form"
        });
    }
</script>
@endsection

