<table class="table">
<thead class="thead-default">
<tr>
    <th>#</th>
    <th>Date</th>
    <th>Link</th>
</tr>
</thead>
<tbody>
@forelse($lots as $lot)
    <tr>
        <td>{{ $lot->id }}</td>
        <td>{{ $lot->created_at }}</td>
        <td><a href="{{ url('/lot/view/'.$lot->id) }}">View</a></td>
    </tr>
@empty
    <tr>
        <td colspan="3">No Lots Found</td>
    </tr>
@endforelse
</tbody>
</table>
{{ $lots->links() }}
