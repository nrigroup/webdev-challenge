@extends('layouts.default')
@section('content')
<br/><br/>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Item</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('itemCRUD.index') }}"> Back</a>
            </div>
        </div>
    </div>

<!-- Input Validation -->
 @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('route' => 'itemCRUD.store','method'=>'POST')) !!}
    <div class="row">
        <!-- Date -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date:</strong>
                {!! Form::date('date', null, array('placeholder' => 'Date','class' => 'form-control')) !!}
            </div>
        </div>
        
        <!-- Category -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category:</strong>
                {!! Form::text('category', null, array('placeholder' => 'Category','class' => 'form-control')) !!}
            </div>
        </div>
        
        <!-- Lot Title -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lot Title:</strong>
                {!! Form::text('lot_title', null, array('placeholder' => 'Lot Title','class' => 'form-control')) !!}
            </div>
        </div>
        
        <!-- Lot Location -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lot Location:</strong>
                {!! Form::text('lot_location', null, array('placeholder' => 'Lot Location','class' => 'form-control')) !!}
            </div>
        </div>
        
        <!-- Lot Condition -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lot Condition:</strong>
                {!! Form::text('lot_condition', null, array('placeholder' => 'Lot Condition','class' => 'form-control')) !!}
            </div>
        </div>
        
        <!-- Per Tax Amount -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Pre Tax Amount:</strong>
                {!! Form::text('pre_tax_amount', null, array('placeholder' => 'Pre Tax Amount','class' => 'form-control')) !!}
            </div>
        </div>
        
        <!-- Tax Name -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tax Name:</strong>
                {!! Form::text('tax_name', null, array('placeholder' => 'Tax Name','class' => 'form-control')) !!}
            </div>
        </div>

        <!-- Tax Amount -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tax Amount:</strong>
                {!! Form::text('tax_amount', null, array('placeholder' => 'Tax Amount','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection