@extends('layouts.master')

@section('body')
    <div class="col-sm-10 offset-sm-1 text-center">
        <br/>
        <a href="{{ url('/') }}">Upload a new Lot</a>
    </div>
    <br/>

    <div id="lots">
        @include('lots.list')
    </div>


@stop