@extends('layouts.master')

@section('content')
<div class="container">
<legend>Upload History</legend>
  <table class="table table-hover table-striped">
   <thead class="thead-dark">
		<tr>
            <th>Lot Set #</th>
            <th>Uploaded Date</th>
        </tr>
	</thead>
	<tbody>
		@forelse($lotSets as $lotSet)
            <tr class='clickable-row' style='cursor: pointer;' data-href={{ route('showLotSet', ['id' => $lotSet->id]) }}>
                <td>{{ $lotSet->id }}</td>
                <td>{{ $lotSet->created_at }}</td>
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