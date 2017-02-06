@extends('layouts.app')

@section('content')

<h1 class="page-header">Upload - ID: {{ $id }} <small>{{ $timestamp }}</h1>

<h2>Summary</h2>


<div class="row">
<div class="col-lg-6 col-lg-offset-3">
@include('items.display_summary', $summary)
</div>
</div>
<h2>Detailed</h2>
@include('items.display_items', $items)
@endsection