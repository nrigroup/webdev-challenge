@extends('layouts.main')

@section('content')
<div class="page-header">
  <h1>CSV Results</h1>
</div>
<div>

@if (empty($sumByCategory)&&empty($sumByMonth))
    <!--- Only show if nothing in table-->
    <div class="alert alert-danger" role="alert">No Data in Table!</div>
@else
    <!--- Sum By Category Display -->
    @if (count($sumByCategory)>0)
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Total Sum By Category</div>
            <!-- Table -->
            <table class="table">
                <tr>
                    @foreach ($sumByCategory[0] as $key => $value)
                        <th>
                           {{ ucwords(str_replace('_', ' ', $key)) }} 
                        </th>
                    @endforeach
                </tr>
                @foreach ($sumByCategory as $row)
                    <tr>
                        @foreach ($row as $itemValue)
                            <td>{{ is_numeric($itemValue)?"$".$itemValue:$itemValue}}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
    
    <!--- Sum By Month Display-->
    @if (count($sumByMonth)>0)
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Total Sum By Month</div>
            <!-- Table -->
            <table class="table">
                <tr>
                    @foreach ($sumByMonth[0] as $key => $value)
                        @if ($key == 'year')
                            @continue
                        @endif
                        <th>
                           {{ ucwords(str_replace('_', ' ', $key)) }} 
                        </th>
                    @endforeach
                </tr>
                @foreach ($sumByMonth as $row)
                    <tr>
                        <td>{{ date("F", mktime(null, null, null, $row->month, 1)) }}</td>
                        <td>${{ $row->pre_tax_amount_sum }}</td>
                        <td>${{ $row->tax_amount_sum }}</td>
                        <td>${{ $row->total }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
@endif

</div>
@endsection