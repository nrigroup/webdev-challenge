@extends('layouts.app')

@section('content')

<form action="{{url('/importFile')}}" method="post" enctype="multipart/form-data">
  @csrf
  @if (session('errors'))
  @foreach ($errors as $error)

  <li>{{$error}}</li>
  @endforeach
  @else
  {{session('success')}}
  @endif

  Select file to upload...
  <input type="file" name="file" id="file">
  <button type="submit">UPLOAD</button>
</form>
@endsection