	<table class="table table-bordered">
		<thead>
			<tr>
				@foreach($csvheader as $headers)
					<th class="white-text">{{$headers}}</th>
				@endforeach
			</tr>
		</thead>

		<tbody>
			<tr>
				@foreach($csvbody as $body)
					@if(is_array($body))
						@foreach($body as $row)
							<td class="white-text">{{ $row }}</td>
						@endforeach
						</tr>
					@endif
				@endforeach
		</tbody>
	</table>
