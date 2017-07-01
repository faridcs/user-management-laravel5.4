<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(asset('admin/global/plugins/datatables/datatables.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')); ?>" rel="stylesheet" type="text/css" />
    <style>
        .bg-female {
            background: deeppink;
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
                                    <i class="icon-users"></i>
                                    <span class="caption-subject bold uppercase"> <?php echo app('translator')->getFromJson('menu.users'); ?> </span>
                                </div>
                                <div class="actions">
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <button id="sample_editable_1_new" class="btn  sbold green"  onclick="addModal()" >
                                                     <?php echo app('translator')->getFromJson('core.btnAddUser'); ?> <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="btn-group pull-right">
                                                <a href="<?php echo e(route('user.export-users')); ?>" class="btn  green  ">
                                                    <?php echo app('translator')->getFromJson('core.exportCsv'); ?>  <i class="fa fa-file-excel-o"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="users">
                                    <thead>
                                    <tr>

                                        <th><?php echo app('translator')->getFromJson('core.id'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('core.avatar'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('core.name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('core.email'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('core.gender'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('core.role'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('core.status'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('core.actions'); ?></th>
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
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>

    <div id="addEditModal" class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                
            </div>
        </div>
    </div>

    <?php echo $__env->make('admin.include.delete-modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts-footer'); ?>
    <!-- DataTables -->
    <script src="<?php echo e(asset('admin/global/plugins/datatables/datatables.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')); ?>" type="text/javascript"></script>
    <script type="text/javascript">

        var table = $('#users').dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "pagingType": "bootstrap_full_number",

            "bProcessing": true,
            "bServerSide": true,
            "ajax": "<?php echo e(route('user.get-users')); ?>",

            "aoColumns": [
                {data: 'id', name: 'id'},
                {data: 'avatar', name: 'avatar'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'gender', name: 'gender'},
                {data: 'roles', name: 'roles',searchable: false, orderable: false },
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            "lengthMenu": [
                [10, 15, 20, -1],
                [10, 15, 20, "All"] // change per page values here
            ],
            "order": [
                [0, "desc"]
            ]
        });

        // Show Delete Modal
        function deleteAlert(id, name) {

            $('#deleteModal').modal('show');

            var confirmMsg = '<?php echo trans('messages.deleteConfirm', ["name" => ":name"]); ?>';
            confirmMsg = confirmMsg.replace(":name", name);

            $("#deleteModal").find('#info').html(confirmMsg);

            $('#deleteModal').find("#delete").off().click(function () {
                var url = "<?php echo e(route('user.users.destroy',':id')); ?>";
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


        // Show Add modal
        function addModal() {
            $.ajaxModal('#addEditModal','<?php echo e(route('user.users.create')); ?>');
        }
        // Show Role modal
        function roleModal(id) {
            var url  ="<?php echo e(route('user.role-modal',':id')); ?>";
            url      = url.replace(':id',id);
            $.ajaxModal('#addEditModal',url);
        }

        // Assign role to user
        function assignRole($id) {

            var url = '<?php echo e(route('user.update-role')); ?>';

            $.easyAjax({
                type: 'POST',
                url: url,
                data: $('#assign-role').serialize(),
                container: "#assign-role",
                success: function(response) {
                    if (response.status == "success") {
                        $('#addEditModal').modal('hide');
                        table._fnDraw();
                    }
                }
            });
        }
        // Show Edit Modal
        function editModal(id) {
            var url  ="<?php echo e(route('user.users.edit',':id')); ?>";
            url      = url.replace(':id',id);
            $.ajaxModal('#addEditModal',url);
        }

        // Update User Function ajax request
        function addEditUser(id) {
            if(typeof id!='undefined'){
                var url  ="<?php echo e(route('user.users.update',':id')); ?>";
                url      = url.replace(':id',id);
            }else{
                url = "<?php echo e(route('user.users.store')); ?>";

            }

            $.easyAjax({
                type: 'POST',
                url: url,
                data: $('#add-edit-form').serialize(),
                container: "#add-edit-form",
                file:true,
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