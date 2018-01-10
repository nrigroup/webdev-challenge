<table class="table table-bordered table-hover">
			
			<thead>
				<tr>
					<th class="white-text">Month</th>
					<th class="white-text">Total</th>
				</tr>
			</thead>

			<tbody>
			@foreach($monthspending as $month)
				<tr>
					<td class="white-text">{{ $month->months }}</td>
					<td class="white-text">{{ $month->total }}</td>
				</tr>
			</tbody>
			@endforeach

		</table>