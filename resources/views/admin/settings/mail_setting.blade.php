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
                                    <span class="caption-subject bold uppercase"> @lang('menu.mailSettings') </span>
                                </div>
                                <div class="actions">
                                </div>
                            </div>
                            <div class="portlet-body form">
                                {!! Form::open(['url' => '', 'method' => 'post', 'id' => 'settings-form', 'class' => 'form-horizontal']) !!}
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">@lang('core.mailDriver')</label>
                                        <div class="col-md-9">
                                            <input name = "mailDriver" type="text" class="form-control"  value = "{{$global->mail_driver or ''}}">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">@lang('core.mailHost')</label>
                                        <div class="col-md-9">
                                            <input name = "mailHost" type="text" class="form-control"  value = "{{$global->mail_host or ''}}">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">@lang('core.mailPort')</label>
                                        <div class="col-md-9">
                                            <input name = "mailPort" type="text" class="form-control"  value = "{{$global->mail_port or ''}}">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">@lang('core.mailUsername')</label>
                                        <div class="col-md-9">
                                            <input name = "mailUsername" type="text" class="form-control"  value = "{{$global->mail_username or ''}}">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">@lang('core.mailPassword')</label>
                                        <div class="col-md-9">
                                            <input name = "mailPassword" type="password" class="form-control"  value = "{{$global->mail_password or ''}}">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">@lang('core.mailEncryption')</label>
                                        <div class="col-md-9">
                                            <select class="page-header-option form-control" name = "mailEncryption">
                                                <option @if($global->mail_encryption == 'tls') selected @endif value="tls" selected="selected">TLS</option>
                                                <option @if($global->mail_encryption == 'ssl') selected @endif  value="ssl">SSL</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="setting" value="mail">
                                    <div class="form-actions noborder">
                                        <button type="button" class="btn  blue" onclick="addEditmailSettings({{$global->id}})">Submit</button>

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
        function addEditmailSettings(id) {
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

