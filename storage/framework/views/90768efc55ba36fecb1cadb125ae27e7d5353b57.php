<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(asset('admin/global/plugins/datatables/datatables.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')); ?>" rel="stylesheet" type="text/css" />

    <style>
        ul{
            list-style: none;
            padding: 0;
            margin: 0;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
                                    <i class="icon-user"></i>
                                    <span class="caption-subject bold uppercase"> <?php echo app('translator')->getFromJson('menu.roles'); ?> </span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <button id="sample_editable_1_new" class="btn  sbold green" onclick="addModal()">
                                                     <?php echo app('translator')->getFromJson('core.btnAddRole'); ?> <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="users">
                                        <thead>
                                        <tr>
                                            <th><?php echo app('translator')->getFromJson('core.role'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('core.permissions'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('core.description'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('core.action'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </section>

        </div>
        <!-- END CONTENT BODY -->
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>
    <!-- Add FORM -->
    <div id="addEditModal" class="modal fade bs-modal-lg in" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                
            </div>
        </div>
    </div>

    <?php echo $__env->make('admin.include.delete-modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts-footer'); ?>
    <script src="<?php echo e(asset('admin/global/plugins/datatables/datatables.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')); ?>" type="text/javascript"></script>
    <!-- DataTables -->
    <script type="text/javascript">
        var table = $('#users').dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "pagingType": "bootstrap_full_number",

            "bProcessing": true,
            "bServerSide": true,
            "ajax": "<?php echo e(route('user.get-roles')); ?>",

            "aoColumns": [
                {data: 'display_name', name: 'roles.display_name'},
                {data: 'perms', name: 'permissions.display_name', orderable: false, searchable: false},
                {data: 'description', name: 'description', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            "order": [
                [0, "asc"]
            ]
        });


        // Show Add modal
        function addModal() {
            $.ajaxModal('#addEditModal','<?php echo e(route('user.roles.create')); ?>');
        }

        // Show Edit Modal
        function editModal(id) {
            var url  ="<?php echo e(route('user.roles.edit',':id')); ?>";
            url      = url.replace(':id',id);
            $.ajaxModal('#addEditModal',url);
        }

        // Show Delete Modal
        function deleteAlert(id, name) {

            $('#deleteModal').modal('show');

            var confirmMsg = '<?php echo trans('messages.deleteConfirm', ["name" => ":name"]); ?>';
            confirmMsg = confirmMsg.replace(":name", name);

            $("#deleteModal").find('#info').html(confirmMsg);

            $('#deleteModal').find("#delete").off().click(function () {
                var url = "<?php echo e(route('user.roles.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status == "success") {
                            $('#deleteModal').modal('hide');
                            table._fnDraw();
                        }
                    }
                });

            });
        }

        //Add Edit Role
        function addEditRole(id) {
            if(typeof id!='undefined'){
                var url  ="<?php echo e(route('user.roles.update',':id')); ?>"
                url      = url.replace(':id',id);
                var method = 'PUT';
            }else{
                url = "<?php echo e(route("user.roles.store")); ?>";
                var method = 'POST';
            }

            $.easyAjax({
                type: method,
                url: url,
                data: $('#create_edit_role_form').serialize(),
                container: "#create_edit_role_form",
                success: function(response) {
                    if (response.status == "success") {
                        $('#addEditModal').modal('hide');
                        table._fnDraw();
                    }
                }
            });
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>