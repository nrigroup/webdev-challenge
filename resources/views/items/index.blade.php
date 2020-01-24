@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong>Upload Item</strong> Details
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ action('ItemController@import') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="file-input" class=" form-control-label">File input</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="file-input" name="file-input" class="form-control-file">
                                </div>
                                @if ($errors->has('item-file'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('item-file') }}</strong>
                                </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Import
                            </button>
                        </form>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>

@endsection