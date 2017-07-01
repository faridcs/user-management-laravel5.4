<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <i class="icon-{{$iconEdit or $icon }} font-red-sunglo"></i>
            <span class="caption-subject bold uppercase">
         @if(isset($permissions->id)) @lang('menu.editField')@else @lang('menu.addField') @endif
            </span>
        </div>
    </div>

<div class="portlet-body form">
{!!  Form::open(['url' => '' ,'method' => 'post', 'id' => 'create_edit_fields_form','class'=>'form-horizontal']) 	 !!}
    <div class="box-body form">
        <div class="form-body">
            <div class="form-group form-md-line-input">
                <label class="col-sm-2 control-label" for="name">@lang('core.label')</label>
                <div class="col-sm-10">
                    <input type="text" name="label" id="label" class="form-control"   placeholder="Enter Custom field Label" onkeyup="slug(this.value)">
                    <div class="form-control-focus"> </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-sm-2 control-label" for="name">@lang('core.name')</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control"   placeholder="Enter Custom field name">
                    <div class="form-control-focus"> </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-sm-2 control-label" for="required">@lang('core.required')</label>
                <div class="col-sm-10">
                    <div class="radio">
                        <label>
                            <input type="radio" name="required" id="optionsRadios1" value="yes" checked>
                            @lang('core.yes')
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="required" id="optionsRadios2" value="no" >
                            @lang('core.no')
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-sm-2 control-label" for="display_name">@lang('core.type')</label>
                <div class="col-sm-10">
                    {!! Form::select('type',
                        [
                            'text'      => 'text',
                            'number'    =>'number',
                            'password'  => 'password',
                            'textarea'  =>'textarea',
                            'select'    =>'select',
                            'radio'    =>'radio',
                            'date'      =>'date'

                        ],
                        '',['class' => 'form-control gender','id' => 'type'])
                     !!}
                </div>
            </div>

            <div class="form-group form-md-line-input mt-repeater" style="display: none;">

                <div data-repeater-list="group">
                    <div data-repeater-item>
                        <div class="row mt-repeater-row">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-md-8">
                                <label class="control-label">Value</label>
                                <input type="text" name="value[]" class="form-control" /> </div>
                            <div class="col-md-1">
                                <a href="javascript:;" data-repeater-delete class="btn btn-danger btn-xs mt-repeater-delete">
                                    <i class="fa fa-close"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add">
                            <i class="fa fa-plus"></i> Add More Value</a>
                    </div>
                </div>

            </div>

        </div>
    </div>

<div class="modal-footer">
    <button class="btn  dark " data-dismiss="modal" aria-hidden="true">Close</button>
    <button id="save" type="submit" class="btn green" onclick="addEditFields();return false">Submit</button>
</div>
{{ Form::close() }}
</div>
</div>
<script>
    var FormRepeater = function () {

        return {
            //main function to initiate the module
            init: function () {
                $('.mt-repeater').each(function(){
                    $(this).repeater({
                        show: function () {
                            $(this).slideDown();
                            $('.date-picker').datepicker({
                                rtl: App.isRTL(),
                                orientation: "left",
                                autoclose: true
                            });
                        },

                        hide: function (deleteElement) {
                                $(this).slideUp(deleteElement);
                        },

                        ready: function (setIndexes) {

                        },
                        isFirstItemUndeletable: true,


                    });
                });
            }

        };

    }();

    jQuery(document).ready(function() {
        FormRepeater.init();
    });

    $('#type').on('change', function () {
        // if (this.value == '1'); { No semicolon and I used === instead of ==
        if (this.value === 'select' || this.value === 'radio' || this.value === 'checkbox'){
            $(".mt-repeater").show();
        } else {
            $(".mt-repeater").hide();
        }
    });

    function convertToSlug(Text)
    {
        return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-')
                ;
    }

    function slug(text){
        $('#name').val(convertToSlug(text));
    }
</script>

