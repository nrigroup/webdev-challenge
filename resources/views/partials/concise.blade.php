<table class="table table-hover table-stripped">
	<thead>
		<tr>
			<th>Group</th>
			<th>Total($)</th>
		</tr>
	</thead>
	<tbody>
		@foreach($groupTotal as $group => $total)
		<tr>
			<td>{{$group}}</td>
			<td>{{$total}}</td>
		</tr>
		@endforeach
	</tbody>
</table>