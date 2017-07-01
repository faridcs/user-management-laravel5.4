@extends('admin.layouts.user')
@section('style')
    <link href="{{ asset('admin/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .bg-female {
            background: deeppink;
        }

    </style>
@endsection
@section('content')
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
                                    <i class="fa fa-sign-out"></i>
                                    <span class="caption-subject bold uppercase"> Active Sessions </span>
                                </div>
                                <div class="actions">
                                </div>
                            </div>
                            <div class="portlet-body">

                                <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="sessions">
                                    <thead>
                                    <tr>
                                        <th width="20%">@lang('core.user')</th>
                                        <th>@lang('core.ip_address')</th>
                                        <th>@lang('core.user_agent')</th>
                                        <th>@lang('core.last_activity')</th>
                                        <th>@lang('core.actions')</th>
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
                {{--Content to inserted by ajax data--}}
            </div>
        </div>
    </div>

    @include('admin.include.delete-modal')
@endsection

@section('scripts-footer')
    <!-- DataTables -->
    <script src="{{ asset('admin/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

        var table = $('#sessions').dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "pagingType": "bootstrap_full_number",

            "bProcessing": true,
            "bServerSide": true,
            "ajax": "{{route('get-sessions')}}",

            "aoColumns": [
                {data: 'name', name: 'name'},
                {data: 'ip_address', name: 'ip_address'},
                {data: 'user_agent', name: 'user_agent'},
                {data: 'last_activity', name: 'last_activity'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            "lengthMenu": [
                [10, 15, 20, -1],
                [10, 15, 20, "All"] // change per page values here
            ],
            "order": [
                [3, "desc"]
            ]
        });

        // Show Delete Modal
        function deleteAlert(id) {

            $('#deleteModal').modal('show');

            var confirmMsg = '{!! trans('messages.deleteConfirmSession') !!}';

            $("#deleteModal").find('#info').html(confirmMsg);

            $('#deleteModal').find("#delete").off().click(function () {
                var url = "{{ route('sessions.destroy',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

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

    </script>
@endsection