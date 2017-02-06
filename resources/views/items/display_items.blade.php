<table class="table table-striped">
<thead>
<tr>
    <th>ID</th>
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
@foreach($items as $item)
<tr>
    <td>{{ $item->id }}</td>
    <td>{{ $item->date }}</td>
    <td>{{ $item->category }}</td>
    <td>{{ $item->lot_title }}</td>
    <td>{{ $item->lot_location }}</td>
    <td><span class="label label-default">{{ $item->lot_condition }}</span></td>
    <td align="right">{{ $item->pretax_amount }}</td>
    <td>{{ $item->tax_name }}</td>
    <td align="right">{{ $item->tax_amount }}</td>
</tr>
@endforeach
</tbody>
</table>