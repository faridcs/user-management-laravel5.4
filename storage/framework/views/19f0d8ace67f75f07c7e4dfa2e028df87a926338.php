<div class="page-footer">
    <div class="page-footer-inner">
        <strong>Copyright &copy; <?php echo e(Carbon\Carbon::now()->format('Y')); ?> <?php echo e($global->site_name); ?></strong> <?php echo app('translator')->getFromJson('messages.allRightsReserved'); ?>

    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- Add FORM -->
<div id="AdminEditModal" class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>