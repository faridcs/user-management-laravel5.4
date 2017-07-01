<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <i class="icon-{{$iconEdit or $icon }} font-red-sunglo"></i>
            <span class="caption-subject bold uppercase">
         @if(isset($permissions->id)) @lang('menu.editPermission')@else @lang('menu.addPermission') @endif
            </span>
        </div>
    </div>

<div class="portlet-body form">
{!!  Form::open(['url' => '' ,'method' => 'post', 'id' => 'create_edit_role_form','class'=>'form-horizontal']) 	 !!}
    <div class="box-body form">
        <div class="form-body">
            <div class="form-group form-md-line-input">
                <label class="col-sm-2 control-label" for="name">@lang('core.name')</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control"  value="{{ $permissions->name or old('name') }}" placeholder="Enter role name">
                    <div class="form-control-focus"> </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-sm-2 control-label" for="display_name">@lang('core.displayName')</label>
                <div class="col-sm-10">
                    <input type="text" id="display_name" class="form-control"  value="{{ $permissions->display_name or old('display_name') }}" name="display_name" placeholder="Enter role display name">
                    <div class="form-control-focus"> </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-sm-2 control-label" for="description">@lang('core.description')</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="description" id="description">{{ $permissions->description or old('description') }}</textarea>
                    <div class="form-control-focus"> </div>
                    <span class="help-block"></span>
                </div>
            </div>
        </div>
    </div>

<div class="modal-footer">
    <button class="btn  dark " data-dismiss="modal" aria-hidden="true">Close</button>
    <button id="save" type="submit" class="btn  green" onclick="editPermission({{$permissions->id or ''}});return false">Submit</button>
</div>
{{ Form::close() }}
</div>
</div>

