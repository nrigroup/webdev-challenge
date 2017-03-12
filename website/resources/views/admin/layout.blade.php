<!DOCTYPE html>
<html>
<head>
    @include('admin.meta')
</head>
<body>
@include('admin.header')

<div class="container">
    <div class="row">
        @include('admin.sidebar')
        @yield('content')
    </div>
</div>

@include('admin.footer')
</body>
</html>
