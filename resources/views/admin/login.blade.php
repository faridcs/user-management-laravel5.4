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
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{ asset('admin/favicon.ico') }}" /> </head>

</head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
    <img src="{{ asset('/logo/'.$global->logo) }}" height="40px" alt="">
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    {!!  Form::open(['url' => '', 'method' => 'post','class'=>'login-form','id'=>'login-form']) 	 !!}
    <h3 class="form-title font-green">{{ $pageTitle }}</h3>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
    <div class="form-actions">
        <button type="submit" class="btn  green uppercase" onclick="login();return false;" >@lang('core.signIn')</button>
        @if($global->remember_me == 1)
            <label class="rememberme check mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember"  value="1" />Remember
                <span></span>
            </label>
        @endif
        @if($global->forget_password == 1)
            <a href="{{route('get-reset')}}" id="forget-password" class="forget-password">Forgot Password?</a>
        @endif
    </div>
    <div class="login-options">
        <h4>Or login with</h4>
        <ul class="social-icons">
            <li>
                <a class="social-icon-color facebook" data-original-title="facebook" href="{{ route('social.login',['facebook']) }}"></a>
            </li>
            <li>
                <a class="social-icon-color twitter" data-original-title="Twitter" href="{{ route('social.login',['twitter']) }}"></a>
            </li>
            <li>
                <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="{{ route('social.login',['google']) }}"></a>
            </li>
        </ul>
    </div>
    @if($global->allow_register == 1)
        <div class="create-account">
            <p>
                <a href="{{route('get-register')}}" id="register-btn" class="uppercase">Create an account</a>
            </p>
        </div>
    @endif
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
<script>
    
    function login(){
        $.easyAjax({
            url: "{!! route('user.login_check') !!}",
            type: "POST",
            data: $("#login-form").serialize(),
            container: "#login-form",
            messagePosition: "inline"
        });
    }
</script>

<!-- End Login Script-->
</body>

</html>