@extends('layouts.app')

@section('content')
            <div class="jumbotron text-center">
                <h1>{{$title}}</h1>
                <hr>
                
                <!-- Show Records If file imported Successfully -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Message -->
                @if(Session::has('message'))
                    <div class="alert alert-danger">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <!-- Form -->
                <form method='post' action='/uploadFile' enctype='multipart/form-data' >
                    {{ csrf_field() }}
                    <input type='file' name='uploadedFile' >
                    <input type='submit' class="btn btn-primary" name='import' value='Import CSV File'>
                </form>
            </div>
@endsection