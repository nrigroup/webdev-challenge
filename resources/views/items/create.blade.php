@extends('layouts.master')

@section('body')

<section>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-sm-10 offset-sm-1 text-center">
                    <h1>Lot Upload Form</h1>
                    <div>
                        <form id="itemForm" method="POST" action ="/item/store" class="form-inline justify-content-center" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <input name="item_file" type="file" class="form_control" required>
                                @if ($errors->any())
                                    <br/>
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <button id="process_items" type="submit" class="btn btn-success ml">Process Items</button>

                            {{ csrf_field() }}
                        </form>
                    </div>
                    <br>
                </div>
                <div class="col-sm-10 offset-sm-1 text-center">
                        <a href="{{ url('/lot/index') }}">View Previous Lots</a>
                </div>
            </div>
        </div>
    </div>
</section>

@stop