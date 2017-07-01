<div class="page-footer">
    <div class="page-footer-inner">
        <strong>Copyright &copy; {{ Carbon\Carbon::now()->format('Y') }} {{ $global->site_name }}</strong> @lang('messages.allRightsReserved')

    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- Add FORM -->
<div id="AdminEditModal" class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{--Content to inserted by ajax data--}}
        </div>
    </div>
</div>