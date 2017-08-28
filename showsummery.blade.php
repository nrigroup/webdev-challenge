@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <p>Displays the total spending amount per-month and per-category</p> 
        <table class="table">
            <thead>
                <td>Month</td>
                <td>Category</td>
                <td>Spending Amount</td>
            </thead>
            @foreach($sums as $sum)
            <tr>
                <td>{{$sum->month}}</td>
                <td>{{$sum->category}}</td>
                <td>{{$sum->spending}}</td>
            </tr>
            
            @endforeach
            </table>
        </div>
    </div>
</div>
@endsection

