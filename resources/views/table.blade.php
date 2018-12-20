<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <title>NRI Web Challenge</title>

    </head>
    <body>
        {{-- @include('inc.navbar') --}}
        <div class="container">
            {{-- @include('inc.message')
            @yield('content') --}}
            @if (count($products) > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>category</th>
                        <th>total spending (tax amount + pre-tax amount)</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p> No data</p>
            @endif
        </div>
    </body>
</html>
