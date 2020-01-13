@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Total Spending Amount Per Month</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Total</th>
                        <th>Month</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monthlySpending as $item)
                    <tr>
                        <td>{{$item->year}}</td>
                        <td>{{ date("F", mktime(0, 0, 0, $item->month, 1)) }}</td>
                        <td>${{number_format($item->total, 2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Total Spending Amount Per Month & Category</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Category</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monthlySpendingPerCategory as $item)
                    <tr>
                        <td>{{$item->year}}</td>
                        <td>{{ date("F", mktime(0, 0, 0, $item->month, 1)) }}</td>
                        <td>{{$item->category}}</td>
                        <td>${{number_format($item->total,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection