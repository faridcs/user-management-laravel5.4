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
                                    <span class="caption-subject bold uppercase"> @lang('menu.generalSettings') </span>
                                </div>
                                <div class="actions">
                                </div>
                            </div>
                            <div class="portlet-body form">
                                {!! Form::open(['url' => '', 'method' => 'POST', 'id' => 'general-form', 'enctype' => 'multipart/form-data']) !!}
                                <input type="hidden" name="setting" value="general">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <input name = "site_name" id="site_name" type="text" class="form-control"  value = "{{$global->site_name or ''}}"/>
                                        <label for="form_control_1">@lang('menu.siteName')</label>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input name = "name" id="name" type="text" class="form-control"  value = "{{$global->name or ''}}"/>
                                        <label for="form_control_1">@lang('core.name')</label>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input name = "email" id="email" type="email" class="form-control"  value = "{{$global->email or ''}}"/>
                                        <label for="form_control_1">@lang('core.email')</label>
                                    </div>


                                    <div class="form-group ">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                                <img src="{{ $global->logo != null ? asset('/logo/'.$global->logo) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA' }}" alt="" /> </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                            <div>
                                                    <span class="btn btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="image" id="image"> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                        <div class="clearfix margin-top-10">
                                            <span class="label label-danger">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead. </div>
                                    </div>
                                    <div class="form-actions noborder">
                                        <button type="button" class="btn  blue" onclick="addEditGeneral({{$global->id}})">Submit</button>

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
        function addEditGeneral(id) {
            var url = "{{route('settings.update',':id')}}";
            url = url.replace(':id',id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: "#general-form",
                file: true
            });
        }
    </script>
@endsection

