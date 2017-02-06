@extends('layouts.app')

@section('content')
<h1 class="page-header">Item Summary</h1>
<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        @include('items.display_summary', $summary)
    </div>
</div>
@endsection