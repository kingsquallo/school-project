@extends('backend.master')
@section('title','Report')
@section('content')

<section class="content-header">
    <h1>
        List Reports
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Report</li>
    </ol>
</section>
@include('backend.report._modal')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="panel-title">
                        DataTables Report
                    </p>
                </div>
                <div class="panel-body">
                    <table id="reports-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Reason</th>
                                <th>Message</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th style="width: 18%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('css')
<link rel="stylesheet" href="{{  asset('layout/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush
@push('script')
<script src="{{  asset('layout/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{  asset('layout/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    var reports_table = $('#reports-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('admin.api.reports') !!}",
        columns: [
            {data: 'id',name: 'id'},
            {data: 'reason',name: 'reason'},
            {data: 'message',name: 'message'},
            {data: 'email',name: 'email'},
            {data: 'created_at',name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
</script>
<script src="{{ asset('layout/backend/js/myscript/report.js') }}"></script>
@endpush
