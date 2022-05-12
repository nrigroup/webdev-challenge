@extends('layouts.master')
@section('title', 'DataView')
@section('content')
@include('modals.addData')
    <div class="container">
        <div class="top_bar">
            <div class="top_left">
                <h1 class="head">
                    Full Data
                </h1>
                <p class="head_meta">
                    Access all your data
                </p>
            </div>

            <div class="top_right">
                <button class="add_data">
                    <span>+</span> Add new data
                </button>
            </div>
        </div>

        <table id="data" class="display">
            <thead>
                <th>ID</th>
                <th>Date</th>
                <th>Category</th>
                <th>Lot Title</th>
                <th>Lot Location</th>
                <th>Lot Condition</th>
                <th>Pre-tax Amount</th>
                <th>Tax Name</th>
                <th>Tax Amount</th>
                <th>Delete</th>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['date']}}</td>
                        <td>{{$item['category']}}</td>
                        <td>{{$item['lot title']}}</td>
                        <td>{{$item['lot location']}}</td>
                        <td>{{$item['lot condition']}}</td>
                        <td>${{number_format($item['pre-tax amount'], 2)}}</td>
                        <td>{{$item['tax name']}}</td>
                        <td>${{number_format($item['tax amount'], 2)}}</td>
                        <td>
                            <button class="submit">
                                <a href="/dataview/{{$item['id']}}">Delete</a>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
</html>
