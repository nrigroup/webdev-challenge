@extends('admin.layout')


@section('additionalstyles')
{{ HTML::style('/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}
{{ HTML::style('/bower_components/datatables-responsive/css/dataTables.responsive.css') }}
@stop


@section('heading')
    <div class="col-lg-12">
        <h1 class="page-header">Spending Reports</h1>
    </div>
@stop


@section('content')
            <div class="row">
                <div class="col-lg-12">
                    <label>Spending by Month</label>
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-monthlyspending">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Spending</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($months as $month)
                                            <tr>
                                                <td>{{ $month->month }}, {{ $month->year }}</td>
                                                <td>${{ $month->spending }}</td>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label>Spending by Category</label>
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-categoryspending">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Spending</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->category }}</td>
                                                <td>${{ $category->spending }}</td>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

@stop


@section('additionaljavascriptincludes')
{{ HTML::script('/bower_components/datatables/media/js/jquery.dataTables.min.js') }}
{{ HTML::script('/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}
{{ HTML::script('/js/bootstrap-confirmation.js') }}
@stop

@section('additionaljavascript')
    <script>
    $(document).ready(function() {
        $('#dataTables-monthlyspending').DataTable({
            responsive: true,
            "bSort" : true
        });
    });

    $(document).ready(function() {
        $('#dataTables-categoryspending').DataTable({
            responsive: true,
            "bSort" : true
        });
    });

    </script>


@stop
