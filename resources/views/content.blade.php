@extends('welcome')

<div class="gradient">

    @section('content')
    @include('validation')
    <div class="container">
        <div class="row">

            <div class="jumbotron center">
                <h1 class="white-text">Welcome to {{ config('app.name') }}</h1>

                <div class="jumbotron bottom">
                    <div class="center-block">

                        <!-- Import upload form -->
                        @include('upload')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection