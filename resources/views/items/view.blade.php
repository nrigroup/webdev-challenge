@extends('layouts.app')

@section('content')
<h1 class="page-header">Items - Detailed</h1>
<div class="row">
    <div class="col-lg-12">
        @include('items.display_items', $items)
    </div>
</div>
    <!-- Pagination -->
<div class="row">
    <div class="col-lg-12 text-center">
      {{ $items->links() }}
    </div>
</div>
@endsection