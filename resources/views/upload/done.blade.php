@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Item Totals</div>

                <div class="panel-body">
                    <h1>Item totals</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Total spending</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($totals as $total)
                            <tr>
                                <th>{{ $total->category }}</th>
                                <td>${{ $total->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection