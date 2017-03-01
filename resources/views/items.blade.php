@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-md-12">
    <h1 class="text-center">View Per Category</h1>
    <table class="table">
      <tr>
        @foreach($sumPerCategory[1] as $key => $value)
        <th>
          {{ ucwords(str_replace('_', ' ', $key))}}
        </th>
        @endforeach
      </tr>
      @foreach($sumPerCategory as $row)
      <tr>
        @foreach($row as $val)
        <td>
          {{$val}}
        </td>
        @endforeach
      </tr>
      @endforeach
    </table>
    <h1 class="text-center">View Per Month</h1>
    <table class="table">
      <tr>
        @foreach($sumPerMonth[0] as $key => $value)
        <th>
          {{ ucwords(str_replace('_', ' ', $key))}}
        </th>
        @endforeach
      </tr>
      @foreach($sumPerMonth as $row)
      <tr>
        @foreach($row as $monthVal)
        <td>
          {{$monthVal}}
        </td>
        @endforeach
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
