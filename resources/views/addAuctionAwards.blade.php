@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h1>Import A CSV File</h1>
             <!-- Message -->
             @if(Session::has('message'))
             <div class="alert alert-danger" role="alert">
                {{ Session::get('message') }}
            </div>
             @endif

             @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif

             <!-- Form -->
             <form method='post' action='uploadFile' enctype='multipart/form-data' >
               {{ csrf_field() }}
               <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                    <label for="file">Add File</label>
                    <input type='file' name='file' class="form-control" id="file" name="file" placeholder="file">{{ old('file') }}
                    @if($errors->has('file'))
                        <span class="help-block">{{ $errors->first('file') }}</span>
                    @endif
                </div>

               <input type='submit' name='submit' value='Import'>
             </form>
        </div>
    </div>
@endsection