<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>{{ $global->site_name }} | {{ $pageTitle }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('admin/global/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('admin/global/css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('admin/pages/css/login.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{ asset('admin/favicon.ico') }}" /> </head>
</head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
    <img src="{{ asset('/logo/'.$global->logo)  }}" height="40px" alt="">
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
<p id="alert"></p>
    <!-- BEGIN REGISTRATION FORM -->
    {!!  Form::open(['url' => '', 'method' => 'POST','class'=>'login-form']) 	 !!}

        <h3 class="font-green">Sign Up</h3>
        
        <p class="hint"> Enter your personal details below: </p>
        <div class="form-group">
            <label class="control-label">Name</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Name" name="name" /> </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label">Email</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" /> </div>
        <div class="form-group">
            <label class="control-label">Password</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" /> </div>

        <div class="form-group">
            <label class="control-label">Re-type Your Password</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="password_confirmation" />
        </div>

        <div class="form-group">
            <label class="control-label">Date Of Birth</label>
            <input type="date" class="form-control form-control-inline date-picker" size="16" name="dob"
                   id="datepicker" placeholder="Date of birth" value="">
        </div>
        <div class="form-group">
        <label class="control-label">Gender</label>

        <div class="md-radio-list">
            <div class="md-radio">
                <input type="radio" name="gender" id="male" class="md-radio" value="male" checked>
                <label for="male">
                    <span></span>
                    <span class="check"></span>
                    <span class="box"></span> Male
                </label>
            </div>
            <div class="md-radio">
                <input type="radio" name="gender" id="female" class="md-radio" value="female">
                <label for="female">
                    <span></span>
                    <span class="check"></span>
                    <span class="box"></span> Female
                </label>
            </div>
        </div>
    </div>

        {{--Custom Fields--}}
        @if($global->custom_field_on_register == 1)
            @foreach($fields as $field)
                <div class="form-group ">
                    <label  class="control-label">{{$field->label}}</label>

                        @if( $field->type == 'text')
                            <input type="text" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" placeholder="{{$field->name}}" value="{{$editUser->custom_fields_data['field_'.$field->id] or ''}}">
                        @elseif($field->type == 'password')
                            <input type="password" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" placeholder="{{$field->name}}" value="{{$editUser->custom_fields_data['field_'.$field->id] or ''}}">
                        @elseif($field->type == 'number')
                            <input type="number" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" placeholder="{{$field->name}}" value="{{$editUser->custom_fields_data['field_'.$field->id] or ''}}">

                        @elseif($field->type == 'textarea')
                            <textarea name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" id="{{$field->name}}" cols="3" placeholder="{{ucwords($field->name)}}">{{$editUser->custom_fields_data['field_'.$field->id] or ''}}</textarea>

                        @elseif($field->type == 'radio')
                            <div class="md-radio-list">

                                @foreach($field->values as $key=>$value)
                                    <div class="md-radio">
                                        <input type="radio" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" id="optionsRadios{{$key.$field->id}}"
                                          @if($key==0) checked @endif     class="md-radio" value="{{$value}}">
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
                                   id="datepicker" value="{{ isset($editUser->dob)?Carbon\Carbon::parse($editUser->dob)->format('Y-m-d'):Carbon\Carbon::now()->format('Y-m-d')}}">
                        @endif

                </div>
            @endforeach
        @endif

        @if($global->recaptcha == 1)
            <div class="form-group">
                <label class="control-label">Captcha</label>
                {!! \Greggilbert\Recaptcha\Facades\Recaptcha::render() !!}
            </div>
        @endif

        <div class="form-actions">
            <a href="{{ route('user.login') }}" id="register-back-btn" class="btn default">Back</a>
            <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right" onclick="register();return false">Submit</button>
        </div>

{!! Form::close()  !!}
<!-- END LOGIN FORM -->
</div>
<!--[if lt IE 9]>
<script src="{{ asset('admin/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('admin/global/plugins/excanvas.min.js') }}"></script>
<script src="{{ asset('admin/global/plugins/ie8.fix.min.js') }}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('admin/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>


<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('admin/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<script src="{{ asset('admin/global/plugins/froiden-helper/helper.js')}}"></script>
<script src="{{ asset('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript" ></script>

<script>

    $('.date-picker').datepicker({
        format: 'yyyy-mm-dd'
    });

    function register(){
        $.easyAjax({
            url: "{!! route('post-register') !!}",
            type: "POST",
            data: $(".login-form").serialize(),
            container: ".content",
            messagePosition: "inline",
            success: function (response) {
                if(response.status == 'success'){
                    $('.login-form').remove();
                }
            }
        });
    }
</script>

<!-- End Login Script-->
</body>

</html>