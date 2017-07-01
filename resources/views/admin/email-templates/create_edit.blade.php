<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <i class="icon-{{$iconEdit}} font-red-sunglo"></i>
            <span class="caption-subject bold uppercase">
         @lang('menu.editEmailTemplate')
            </span>
        </div>
    </div>
    <div class="portlet-body form">
        {!!  Form::open(['url' => '','class'=>'form-horizontal' ,'autocomplete'=>'off','id'=>'add-edit-form']) 	 !!}
        <div class="box-body form">
            <div class="form-body">
                <div class="form-group form-md-line-input">
                    <label class="col-sm-2 control-label" for="name">@lang('core.id')</label>
                    <div class="col-sm-10">
                        <input type="text" name="id" id="id" class="form-control"  placeholder="@lang('core.id')" value="{{$editTemplate->email_id or ''}}" disabled>
                        <span class="form-control-focus"> </span>
                        <span class=" help-block help-block-error" style="color: #e73d4a;">You can't change ID</span>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-sm-2 control-label" for="email">@lang('core.subject')</label>
                    <div class="col-sm-10">
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="@lang('core.subject')" value="{{$editTemplate->subject or ''}}">
                        <div class="form-control-focus"> </div>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">@lang('core.body')</label>
                    <div class="col-md-10">
                        <textarea name="body" class="form-control" rows="10" id="myEditor">{!! $editTemplate->body or '' !!} </textarea>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-sm-2 control-label">@lang('core.variablesUsed')</label>
                    <div class="col-sm-10">
                        {{ $emailVariables or ''}}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn dark " data-dismiss="modal" aria-hidden="true">Close</button>
            <button id="save" type="submit" class="btn green" onclick="addEditUser({{$editTemplate->id or ''}});return false">Submit</button>
        </div>
        {{Form::close()}}
    </div>
</div>

<script>
//    var x = $('#myEditor').markdown();
</script>