@extends('admin.layout')

@section('additionalstyles')
<link href="/dist/css/dropzone.css" media="all" rel="stylesheet" type="text/css" />
@stop

@section('heading')
    <div class="col-lg-12">
        <h1 class="page-header">Upload new Inventory</h1>
    </div>
@stop





@section('content')
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            @if( isset( $menu->createdat ) ) 
                            <b>Created At:</b> {{ $menu->createdat }}
                            @endif
                            &nbsp;
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                {{ Form::open(array('role' => 'form')) }}
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <div id="ad-photos" class="dropzone">
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            Use the file upload box and add as many csv files for processing as desired.  The use the button below to submit them for processing.
                                        </div>
                                        <br />
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </div>
                                {{ Form::close() }}
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

    </div>


@stop




@section('additionaljavascriptincludes')
<script src="/dist/js/dropzone.js" type="text/javascript"></script>
<script>
$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });

    var token = "{{ Session::getToken() }}";
    var baseUrl = "{{ url('/') }}";
    Dropzone.options.adPhotos = {
        url: baseUrl + '/admin/upload-csv',
        params: {
            _token: token
        },
        addRemoveLinks: true,
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 8, // MB
        acceptedFiles: 'text/csv',
        uploadMultipel: true,
        init: function() {
            this.on("removedfile", function(file) {  
                $.post('/admin/upload-remove-csv', { _token:token, name: file.name } );
            });
        }
    };

});
</script>
@stop

@section('additionaljavascript')
@stop
