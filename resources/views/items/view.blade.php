@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Items</h1>
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