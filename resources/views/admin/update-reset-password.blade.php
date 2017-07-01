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
    <!-- BEGIN LOGIN FORM -->
{!!  Form::open(['url' => '', 'method' => 'POST','class'=>'login-form']) 	 !!}
<!-- BEGIN REGISTRATION FORM -->
    <h3 class="form-title font-green">Reset your Password</h3>

    <div class="form-group">
        <label class="control-label">Password</label>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" /> </div>
        <input type="hidden" name="passwordResetCode" value="{{$passwordResetCode}}">
    <div class="form-group">
        <label class="control-label">Re-type Your Password</label>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="password_confirmation" />
    </div>

    <div class="form-actions">
        <a href="{{ route('user.login') }}" id="register-back-btn" class="btn default">Back</a>
        <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right" onclick="changePassword();return false">Submit</button>
    </div>
    <!-- END REGISTRATION FORM -->
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

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('admin/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<script src="{{ asset('admin/global/plugins/froiden-helper/helper.js')}}"></script>

<script>


    function changePassword(){
        $.easyAjax({
            url: "{!! route('post-password-reset') !!}",
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