<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">

<head>
    <?php echo $__env->make('admin.sections.meta-data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('admin.sections.style', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
<!-- BEGIN CONTAINER -->
<?php echo $__env->make('admin.sections.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="clearfix"> </div>

<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php echo $__env->make('admin.sections.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <?php echo $__env->yieldContent('content'); ?>

    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php echo $__env->yieldContent('modals'); ?>
<?php echo $__env->make('admin.sections.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<?php echo $__env->make('admin.sections.footer-scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('scripts-footer'); ?>

</body>
</html>
