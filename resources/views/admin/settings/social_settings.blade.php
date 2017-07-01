@extends('admin.layouts.user')
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
                                    <span class="caption-subject bold uppercase"> @lang('menu.socialSettings') </span>
                                </div>
                                <div class="actions">
                                </div>
                            </div>
                            <div class="portlet-body box-body form">
                                {!! Form::open(['url' => '', 'method' => 'post', 'id' => 'social-form','class'=>'form-hrizontal']) !!}
                                    <div class="form-body">

                                        <h4><strong>Facebook</strong></h4>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-sm-2 control-label" for="name">Facebook Client ID</label>
                                            <div class="col-md-6">
                                                <input type="text" name="facebook_client_id" id="facebook_client_id" class="form-control"   value = "{{$global->facebook_client_id or ''}}">
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-sm-2 control-label" for="name">Facebook Client Secret</label>
                                            <div class="col-md-6">
                                                <input type="text" name="facebook_client_secret" id="facebook_client_secret" class="form-control"   value = "{{$global->facebook_client_secret or ''}}">
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <br>
                                        <h4><strong>Google</strong></h4>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-sm-2 control-label" for="name">Google Client ID</label>
                                            <div class="col-md-6">
                                                <input type="text" name="google_client_id" id="google_client_id" class="form-control"   value = "{{$global->google_client_id or ''}}">
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-sm-2 control-label" for="name">Google Client Secret</label>
                                            <div class="col-md-6">
                                                <input type="text" name="google_client_secret" id="google_client_secret" class="form-control"   value = "{{$global->google_client_secret or ''}}">
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <br>
                                        <h4><strong>Twitter</strong></h4>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-sm-2 control-label" for="name">Twitter Client ID</label>
                                            <div class="col-md-6">
                                                <input type="text" name="twitter_client_id" id="twitter_client_id" class="form-control"   value = "{{$global->twitter_client_id or ''}}">
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-sm-2 control-label" for="name">Twitter Client Secret</label>
                                            <div class="col-md-6">
                                                <input type="text" name="twitter_client_secret" id="twitter_client_secret" class="form-control"   value = "{{$global->twitter_client_secret or ''}}">
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <br>
                                        <h4><strong>Recaptcha</strong></h4>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-sm-2 control-label" for="name">Recaptch Public Key</label>
                                            <div class="col-md-6">
                                                <input type="text" name="recaptcha_public_key" id="recaptch_public_key" class="form-control"   value = "{{$global->recaptcha_public_key or ''}}">
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-sm-2 control-label" for="name">Recaptch Private Key</label>
                                            <div class="col-md-6">
                                                <input type="text" name="recaptcha_private_key" id="recaptcha_private_key" class="form-control"   value = "{{$global->recaptcha_private_key or ''}}">
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" name="setting" value="social">
                                        <div class="form-actions noborder">
                                            <button type="button" class="btn  blue" onclick="addEditSocial({{$global->id}})">Submit</button>

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

@section('scripts-footer')
<script>
    function addEditSocial(id) {
        var url = "{{route('settings.update',':id')}}";
        url = url.replace(':id',id);
        $.easyAjax({
            type: 'PUT',
            url: url,
            data: $('#social-form').serialize(),
            container: "#social-form"
        });
    }
</script>
@endsection

