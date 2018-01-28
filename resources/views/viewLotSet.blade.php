@extends('layouts.master')

@section('content')
<div class="container">
<legend>Lot {{ $lotSet->id }} Summary</legend>
<h4> Total Spending per-month </h4>
  <table class="table table-striped table-bordered">
   <thead class="thead-default">
		<tr>
            <th>Month</th>
            <th>Amount Spent</th>
        </tr>
	</thead>
	<tbody>
		@forelse($spentMonthly as $month => $totalSpent)
            <tr>
                <td>{{ $month }}</td>
                <td>{{ $totalSpent }}</td>
            </tr>
			@empty
            <tr>
                <td>No data to show!</td>
            </tr>
		@endforelse
	</tbody>
  </table>
  <h4> Total Spending per-category </h4>
  <table class="table table-striped table-bordered">
   <thead class="thead-default">
		<tr>
            <th>Category</th>
            <th>Amount Spent</th>
        </tr>
	</thead>
	<tbody>
		@forelse($spentByCategory as $category => $totalSpent)
            <tr>
                <td>{{ $category }}</td>
                <td>{{ $totalSpent }}</td>
            </tr>
			@empty
            <tr>
                <td>No data to show!</td>
            </tr>
		@endforelse
	</tbody>
  </table>
  <h4>Raw Data </h4>
  <table class="table table-striped table-bordered">
   <thead class="thead-dark">
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
		@forelse($lotSet->lots as $lot)
            <tr>
                <td>{{ $lot->date }}</td>
                <td>{{ $lot->category }}</td>
				<td>{{ $lot->lot_title }}</td>
                <td>{{ $lot->lot_location }}</td>
				<td>{{ $lot->lot_condition }}</td>
                <td>{{ $lot->pre_tax_amount }}</td>
				<td>{{ $lot->tax_name }}</td>
                <td>{{ $lot->tax_amount }}</td>
            </tr>
			@empty
            <tr>
                <td>No data to show!</td>
            </tr>
		@endforelse
	</tbody>
  </table>
</div>
@endsection