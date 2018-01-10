	<table class="table table-bordered table-hover">
			<div class="tables">
				
			<thead>
				<tr>
					<th class="white-text">Category</th>
					<th class="white-text">Total</th>
				</tr>
			</thead>

			<tbody>
			@foreach($categoryspending as $category)
				<tr>
					<td class="white-text">{{ $category->category }}</td>
					<td class="white-text">{{ $category->total }}</td>
				</tr>
			</tbody>
			@endforeach

		</table>