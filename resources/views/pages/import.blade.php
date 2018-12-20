@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="panel panel-primary">
      <div class="panel-body"> 
           {!! Form::open(array('action' => 'ExcelController@importFile','method'=>'POST','files'=>'true')) !!}
            <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {!! Form::label('sample_file','Select CSV File to Import:',['class'=>'col-md-3']) !!}
                        <div class="col-md-9">
                        {!! Form::file('sample_file', array('class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
                </div>
            </div>
           {!! Form::close() !!}
     </div>
    </div>
    </div>
@endsection
