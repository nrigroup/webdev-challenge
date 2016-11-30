@extends('rdsadmin.layout')


@section('additionalstyles')
{{ HTML::style('themes/sbadmin2/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}
{{ HTML::style('themes/sbadmin2/bower_components/datatables-responsive/css/dataTables.responsive.css') }}
@stop


@section('heading')
    <div class="col-lg-12">
        @if( $rdsadmin )
        <h1 class="page-header">RDS Admin Menu List</h1>
        @endif
        @if( !$rdsadmin )
        <h1 class="page-header">Admin Menu List</h1>
        @endif
    </div>
@stop


@section('content')
            <div class="row">
                <div class="col-lg-12">
                    <!-- Notifications -->
                    @include('notifications')
                    <!-- ./ notifications -->
                    <label>Side Menu</label>
                    <span style='float: right!important;'>
                        @if( $rdsadmin )
                        <a href='{{ action('RdsAdminController@getRdsAdminMenuForm' ) }}'><i class="fa fa-plus fa-fw"></i> New Menu Item</a>
                        @endif
                        @if( !$rdsadmin )
                        <a href='{{ action('RdsAdminController@getAdminMenuForm' ) }}'><i class="fa fa-plus fa-fw"></i> New Menu Item</a>
                        @endif
                    </span>
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-adminmenusidelist">
                                    <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Name</th>
                                            <th>Url</th>
                                            <th>Icon</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sidemenu as $item)
                                            <tr>
                                                <td>
                                                    @if( $rdsadmin )
                                                    <a href='{{ action('RdsAdminController@getRdsAdminMenuForm', array( $item->id ) ) }}'><i class="fa fa-edit fa-fw"></i> Edit</a>
                                                    @endif
                                                    @if( !$rdsadmin )
                                                    <a href='{{ action('RdsAdminController@getAdminMenuForm', array( $item->id ) ) }}'><i class="fa fa-edit fa-fw"></i> Edit</a>
                                                    @endif 
                                                </td>
                                                <td><i class="fa fa-folder"></i> {{ $item->name }}</td>
                                                <td>{{ $item->url }}</td>
                                                <td><i class="fa fa-{{ $item->fa_icon }}"></i></td>
                                                <td>
                                                    @if( $rdsadmin )
                                                    <a href='{{ action('RdsAdminController@getRdsAdminMenuDelete', array( $item->id ) ) }}' data-toggle="confirmation"><i class="fa fa-times fa-fw"></i></a>
                                                    @endif
                                                    @if( !$rdsadmin )
                                                    <a href='{{ action('RdsAdminController@getAdminMenuDelete', array( $item->id ) ) }}' data-toggle="confirmation"><i class="fa fa-times fa-fw"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @if( $item->submenu )
                                                @foreach ($item->submenu as $subitem)
                                                    <tr>
                                                        <td>
                                                            @if( $rdsadmin )
                                                            <a href='{{ action('RdsAdminController@getRdsAdminMenuForm', array( $subitem->id ) ) }}'><i class="fa fa-edit fa-fw"></i> Edit</a>
                                                            @endif
                                                            @if( !$rdsadmin )
                                                            <a href='{{ action('RdsAdminController@getAdminMenuForm', array( $subitem->id ) ) }}'><i class="fa fa-edit fa-fw"></i> Edit</a>
                                                            @endif 
                                                        </td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-file-o"></i> {{ $subitem->name }}</td>
                                                        <td>{{ $subitem->url }}</td>
                                                        <td><i class="fa fa-{{ $subitem->fa_icon }}"></i></td>
                                                        <td>
                                                            @if( $rdsadmin )
                                                            <a href='{{ action('RdsAdminController@getRdsAdminMenuDelete', array( $subitem->id ) ) }}' data-toggle="confirmation"><i class="fa fa-times fa-fw"></i></a>
                                                            @endif
                                                            @if( !$rdsadmin )
                                                            <a href='{{ action('RdsAdminController@getAdminMenuDelete', array( $subitem->id ) ) }}' data-toggle="confirmation"><i class="fa fa-times fa-fw"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>





                    <label>Top Menu</label>
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-adminmenutoplist">
                                    <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Name</th>
                                            <th>Url</th>
                                            <th>Icon</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topmenu as $item)
                                            <tr>
                                                <td>
                                                    @if( $rdsadmin )
                                                    <a href='{{ action('RdsAdminController@getRdsAdminMenuForm', array( $item->id ) ) }}'><i class="fa fa-edit fa-fw"></i> Edit</a>
                                                    @endif
                                                    @if( !$rdsadmin )
                                                    <a href='{{ action('RdsAdminController@getAdminMenuForm', array( $item->id ) ) }}'><i class="fa fa-edit fa-fw"></i> Edit</a>
                                                    @endif 
                                                </td>
                                                <td><i class="fa fa-folder"></i> {{ $item->name }}</td>
                                                <td>{{ $item->url }}</td>
                                                <td><i class="fa fa-{{ $item->fa_icon }}"></i></td>
                                                <td>
                                                    @if( $rdsadmin )
                                                    <a href='{{ action('RdsAdminController@getRdsAdminMenuDelete', array( $item->id ) ) }}' data-toggle="confirmation"><i class="fa fa-times fa-fw"></i></a>
                                                    @endif
                                                    @if( !$rdsadmin )
                                                    <a href='{{ action('RdsAdminController@getAdminMenuDelete', array( $item->id ) ) }}' data-toggle="confirmation"><i class="fa fa-times fa-fw"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @if( $item->submenu )
                                                @foreach ($item->submenu as $subitem)
                                                    <tr>
                                                        <td>
                                                            @if( $rdsadmin )
                                                            <a href='{{ action('RdsAdminController@getRdsAdminMenuForm', array( $subitem->id ) ) }}'><i class="fa fa-edit fa-fw"></i> Edit</a>
                                                            @endif
                                                            @if( !$rdsadmin )
                                                            <a href='{{ action('RdsAdminController@getAdminMenuForm', array( $subitem->id ) ) }}'><i class="fa fa-edit fa-fw"></i> Edit</a>
                                                            @endif
                                                        </td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-file-o"></i> {{ $subitem->name }}</td>
                                                        <td>{{ $subitem->url }}</td>
                                                        <td><i class="fa fa-{{ $subitem->fa_icon }}"></i></td>
                                                        <td>
                                                            @if( $rdsadmin )
                                                            <a href='{{ action('RdsAdminController@getRdsAdminMenuDelete', array( $subitem->id ) ) }}' data-toggle="confirmation"><i class="fa fa-times fa-fw"></i></a>
                                                            @endif
                                                            @if( !$rdsadmin )
                                                            <a href='{{ action('RdsAdminController@getAdminMenuDelete', array( $subitem->id ) ) }}' data-toggle="confirmation"><i class="fa fa-times fa-fw"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
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
{{ HTML::script('themes/sbadmin2/bower_components/datatables/media/js/jquery.dataTables.min.js') }}
{{ HTML::script('themes/sbadmin2/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}
{{ HTML::script('themes/sbadmin2/js/bootstrap-confirmation.js') }}
@stop

@section('additionaljavascript')
    <script>
    $(document).ready(function() {
        $('#dataTables-adminmenusidelist').DataTable({
            responsive: true,
            "bSort" : false
        });
    });

    $(document).ready(function() {
        $('#dataTables-adminmenutoplist').DataTable({
            responsive: true,
            "bSort" : false
        });
    });

    $('[data-toggle="confirmation"]').confirmation({
        onConfirm: function(event, element) { $(location).attr('href', element[0]['href']) },
        placement : 'left'
    });
    </script>


@stop
