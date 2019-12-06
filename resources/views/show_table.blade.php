@extends('layouts.app')

@section('content')

{{ csrf_field() }}
<div class="container">
  table
       <!-- Message -->
       @if(Session::has('message'))
        <p >{{ Session::get('message') }}</p>
     @endif
  <div class="row justify-content-center">
    <table class="table">
      @foreach ($items as $row)
        <tr>
        @foreach ($row as $key => $value)
          <td>{{ $value }}</td>
        @endforeach
        </tr>
      @endforeach
    </table>
  </div>
</div>

@endsection