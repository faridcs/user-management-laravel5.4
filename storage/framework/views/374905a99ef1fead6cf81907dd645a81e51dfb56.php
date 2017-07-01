
<!--[if lt IE 9] -->
<script src="<?php echo e(asset('admin/global/plugins/respond.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/global/plugins/excanvas.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/global/plugins/ie8.fix.min.js')); ?>"></script>
<!-- [endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo e(asset('admin/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script>


<script src="<?php echo e(asset('admin/global/plugins/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo e(asset('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>


<script src="<?php echo e(asset('admin/global/plugins/counterup/jquery.waypoints.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('admin/global/plugins/counterup/jquery.counterup.min.js')); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo e(asset('admin/global/scripts/app.min.js')); ?>" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo e(asset('admin/layouts/scripts/layout.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('admin/layouts/scripts/demo.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('admin/layouts/global/scripts/quick-sidebar.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('admin/layouts/global/scripts/quick-nav.min.js')); ?>" type="text/javascript"></script>

<script src="<?php echo e(asset('admin/global/plugins/froiden-helper/helper.js')); ?>"></script>
<script src="<?php echo e(asset('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')); ?>" type="text/javascript"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function editAdminModal(id) {
        var url  ="<?php echo e(route('profile.edit',':id')); ?>"
        url      = url.replace(':id',id);
        $.ajaxModal('#AdminEditModal',url);
    }


    function UpdateAdmin(id) {

            var url  ="<?php echo e(route('profile.update',':id')); ?>"
            url      = url.replace(':id',id);

        $.easyAjax({
            type: 'POST',
            url: url,
            data: $('#user-edit-form').serialize(),
            container: "#user-edit-form",
            file: true,
            success: function(response) {
                if (response.status == "success") {
                    $('#AdminEditModal').modal('hide');

                }
            }
        });
    }

</script>
<?php echo $__env->yieldContent('footerjs'); ?>