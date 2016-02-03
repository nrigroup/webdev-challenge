@extends('admin.layout')

@section('additionalstyles')
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
                                    <div class="col-lg-6">
                                        <div class="form-group{{ $errors->has('name')?' has-error':'' }}">
                                            <label class='control-label'>Name</label>
                                            {{ Form::text('name', isset( $menu->name ) ? $menu->name:null, array('class' => 'form-control', 'required' )) }}
                                            @if ($errors->has('name'))
                                            @foreach ($errors->get('name') as $message)
                                                <span class="help-block">
                                                    <span class="glyphicon glyphicon-warning-sign"></span>
                                                    {{ $message }}
                                                </span>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('url')?' has-error':'' }}">
                                            <label class='control-label'>URL</label>
                                            {{ Form::text('url', isset( $menu->url ) ? $menu->url:null, array('class' => 'form-control' )) }}
                                            <p class="help-block">Only required if this has a parent or if it is a parent but has no sub items under it</p>
                                            @if ($errors->has('url'))
                                            @foreach ($errors->get('url') as $message)
                                                <span class="help-block">
                                                    <span class="glyphicon glyphicon-warning-sign"></span>
                                                    {{ $message }}
                                                </span>
                                            @endforeach
                                            @endif
                                        </div>
                                         <div class="form-group">
                                            <label>Location</label>
                                            {{ Form::select('location', array('Side' => 'Side', 'Top' => 'Top'), isset($menu->location)?$menu->location:'Side', array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class='control-label'>Parent</label>
                                            {{ Form::select('parent', [], isset($menu->parent)?$menu->parent:0, array('class' => 'form-control')) }}
                                        </div>
                                        <div class="form-group">
                                            <label class='control-label'>Order</label>
                                            {{ Form::select('order', [], isset($menu->order)?$menu->order:0, array('class' => 'form-control')) }}
                                            <p class="help-block">Works in Descending order, higher number means it will appear higher in the menu</p>
                                        </div>
                                        <div class="form-group{{ $errors->has('fa_icon')?' has-error':'' }}">
                                            <label class='control-label'>Font Awesome Icon</label>
                                            {{ Form::text('fa_icon', isset( $menu->fa_icon ) ? $menu->fa_icon:null, array('class' => 'form-control', 'required' )) }}
                                            <p class="help-block"><a target='_blank' href='http://fortawesome.github.io/Font-Awesome/icons/'>Available Icons</a></p>
                                            @if ($errors->has('fa_icon'))
                                            @foreach ($errors->get('fa_icon') as $message)
                                                <span class="help-block">
                                                    <span class="glyphicon glyphicon-warning-sign"></span>
                                                    {{ $message }}
                                                </span>
                                            @endforeach
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-default">Save</button>
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
@stop

@section('additionaljavascript')
@stop
