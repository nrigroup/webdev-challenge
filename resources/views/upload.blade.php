@extends ('layout')
@section ('content')
        <div class="text-center">
            @if (Route::has('login'))
                <div class="container">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="container">
                <div>
                    <h3>Upload a file</h3>
                </div>                

                <div class="container">
                    <a href="/">Home</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
@endsection