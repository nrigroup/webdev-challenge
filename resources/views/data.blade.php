@extends('layouts.app')

@section('content')
<data-component :records="{{$records}}"></data-component>
@endsection
