@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Import Lot items by uploading CSV
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import</button>
            </form>
        </div>
    </div>
    <hr class="my-4">
    @if(!empty($items))
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="display-6">Total spending amount per-month and per-category:</h3>
            </div>
            <div class="card-body">
                <table id="items_table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Month/Year</th>
                        <th>Category</th>
                        <th>Total Price (amount_pre_tax + tax_amount)</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item['month'] }}</td>
                            <td>{{ $item['category'] }}</td>
                            <td>{{ $item['price'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Month/Year</th>
                        <th>Category</th>
                        <th>Total Price (amount_pre_tax + tax_amount)</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection