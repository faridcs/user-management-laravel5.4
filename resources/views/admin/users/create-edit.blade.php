<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <i class="icon-{{$iconEdit or $icon }} font-red-sunglo"></i>
            <span class="caption-subject bold uppercase">
         @if(isset($editUser->id)) @lang('core.edit')@else @lang('core.add') @endif @lang('core.user')
            </span>
        </div>
    </div>
    <div class="portlet-body form">
        {!!  Form::open(['url' => '','class'=>'form-horizontal' ,'autocomplete'=>'off','enctype' => 'multipart/form-data','id'=>'add-edit-form']) 	 !!}
        @if(isset($editUser->id)) <input type="hidden" name="_method" value="PUT"> @endif
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

                    <div class="form-group form-md-line-input">
                        <label  class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" placeholder="@lang('core.password')">
                            @if(isset($editUser->id))
                                <div class="italic">@lang('messages.leaveBlankPassword')</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-sm-2 control-label">Profile Image</label>
                        <div class="col-sm-10">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                    <img src="{{ isset($editUser->id)?$editUser->getGravatarAttribute(80):'' }}" alt="" /> </div>
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
                    {{---------------------Show Status change for  Edit Users-------------}}
                    @if(isset($editUser->id))
                        <div class="form-group">
                            <label  class="col-sm-2 control-label" for="">@lang('core.status')</label>
                            <div class="col-sm-10">
                                <div class="md-radio-list">
                                    <div class="md-radio">
                                        <input type="radio" name="status" class="md-radio" id="optionsRadios1" value="active" @if($editUser->status=='active') checked @endif>
                                        <label for="optionsRadios1">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> @lang('core.active')
                                        </label>
                                    </div>
                                    <div class="md-radio">

                                        <input type="radio" name="status" class="md-radio" id="optionsRadios2" value="inactive" @if($editUser->status=='inactive') checked @endif>
                                        <label for="optionsRadios2">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> @lang('core.inactive')
                                        </label>
                                    </div>

                                </div>
                            </div>
                            {{--------------------------END HERE----------------------------------}}

                        </div>
                    @endif
                </div>
            </div>

        <div class="modal-footer">
            <button class="btn  dark " data-dismiss="modal" aria-hidden="true">Close</button>
            <button id="save" type="submit" class="btn  green" onclick="addEditUser({{$editUser->id or ''}});return false">Submit</button>
        </div>
        {{Form::close()}}
    </div>
</div>



<script>
    $('.date-picker').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>