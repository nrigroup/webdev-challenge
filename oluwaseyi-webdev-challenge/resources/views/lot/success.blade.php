@extends('app')

@section('title', 'Success')

@section('content')

<h3>Spending By Category</h3>
<ul>
@foreach($spendingByCategory as $spending)
    <li>{{ $spending->category }} - {{ $spending->total_spending }}</li>
@endforeach
</ul>

<h3>Spending per Month</h3>

<ul>
@foreach($spendingPerMonth as $spending)
    <li>{{ $spending->month }}/{{ $spending->year }} - {{ $spending->total_spending }}</li>
@endforeach
</ul>


@endsection
