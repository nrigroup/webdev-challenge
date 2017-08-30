
<table class="table tabel-striped table-hover">
	<thead>
		<tr>
			@foreach($cols as $col)
				<th>{{$col}}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($body as $inventory)
		<tr>
			@foreach($inventory as $data)
				<td>{{$data}}</td>
			@endforeach
		</tr>
		@endforeach
	</tbody>
</table>