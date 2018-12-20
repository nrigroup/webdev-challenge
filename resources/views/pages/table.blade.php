@extends('layouts.app')

@section('content')
    @if (count($products) > 0)
    <table class="table">
        <thead>
        <tr>
            <th>category</th>
            <th>total spending (tax amount + pre-tax amount)</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->category }}</td>
                <td>{{ $product->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!!Form::open(['action' => 'ExcelController@destroyTable', 'method' => 'POST'])!!}
                {{-- {{Form::hidden('_method', 'DELETE')}} --}}
                {{Form::submit('Delete Whole Table', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}


    @else
    <p> No data</p>
    @endif


@endsection


