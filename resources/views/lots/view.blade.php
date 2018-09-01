@extends('layouts.master')

@section('body')
    <div class="col-sm-10 offset-sm-1 text-center">
        <br/>
        <a href="{{ url('/') }}">Upload a new Lot</a> |
        <a href="{{ url('/lot/index') }}">View Previous Lots</a>
    </div>
    <br/>

    <h2>Lot {{ $lot->id }}</h2>

    <table class="table">
        <thead class="thead-default">
        <tr>
            <th>Date</th>
            <th>Amount Spent</th>
        </tr>
        </thead>
        <tbody>
        @forelse($spendingAmountByMonth as $month => $spending)
            <tr>
                <td>{{ $month }}</td>
                <td>{{ $spending }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">No items found!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <br/>

    <table class="table">
        <thead class="thead-default">
        <tr>
            <th>Category</th>
            <th>Amount Spent</th>
        </tr>
        </thead>
        <tbody>
        @forelse($spendingAmountByCategory as $category => $spending)
            <tr>
                <td>{{ $category }}</td>
                <td>{{ $spending }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">No items found!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <br/>

    <table class="table">
        <thead class="thead-default">
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Lot Title</th>
            <th>Lot Location</th>
            <th>Lot Condition</th>
            <th>Pre-Tax Amount</th>
            <th>Tax Name</th>
            <th>Tax Amount</th>
        </tr>
        </thead>
        <tbody>
        @forelse($lot->lotItems as $item)
            <tr>
                <td>{{ $item->date->toDateString() }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->lot_title }}</td>
                <td>{{ $item->lot_location }}</td>
                <td>{{ $item->lot_condition }}</td>
                <td>{{ $item->pre_tax_amount }}</td>
                <td>{{ $item->tax_name }}</td>
                <td>{{ $item->tax_amount }}</td>
            </tr>
            @if ($loop->last)
                <tr>
                    <td>SUBTOTALS</td>
                    <td colspan="4"></td>
                    <td>{{ $lotPreTaxBalance }}</td>
                    <td>&nbsp;</td>
                    <td>{{ $lotTaxBalance }}</td>
                </tr>
                <tr>
                    <td>TOTALS</td>
                    <td colspan="4"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>{{ $lotBalance }}</td>
                </tr>
            @endif
        @empty
            <tr>
                <td colspan="4">No items found!</td>
            </tr>
        @endforelse
        </tbody>
    </table>

@stop