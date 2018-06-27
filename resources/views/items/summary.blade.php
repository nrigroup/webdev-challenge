@extends('layout.master')


@section('content')



<div class="table-responsive">
	<h4>Total Spending Per Category:</h4>
	<table class="table table-striped">
		<tr>
 			<th> Category 		</th>
 			<th> pre_tax_amount </th>
 			<th> tax_amount 	</th>
 			<th> total 			</th>
		</tr>

		@foreach ($spending_per_category as $category) 
			<tr>
				<td> {{ $category['category'] }} 		</td>
				<td> {{ $category['pre_tax_amount'] }} 	</td>
				<td> {{ $category['tax_amount'] }} 		</td>
				<td> {{ $category['amount'] }} 			</td>
			</tr>
		@endforeach

	</table>
</div>

<hr>
<hr>

<div class="table-responsive">
	<h4>Total Spending Per Month:</h4>
	<table class="table table-striped">
		<tr>
 			<th> Month 			</th>
 			<th> pre_tax_amount </th>
 			<th> tax_amount 	</th>
 			<th> total 			</th>
		</tr>

		@foreach ($spending_per_month as $month) 
			<tr>
				<td> {{ $month['date'] }} 			</td>
				<td> {{ $month['pre_tax_amount'] }} </td>
				<td> {{ $month['tax_amount'] }} 	</td>
				<td> {{ $month['amount'] }} 		</td>
			</tr>
		@endforeach

	</table>
</div>
@endsection