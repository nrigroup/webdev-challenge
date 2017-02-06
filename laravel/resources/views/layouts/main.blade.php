<!DOCTYPE html>
<html lang="en">
    <!-- head -->
    <head>
        @include('header')
    </head>
    <!-- end head -->

    <body>
    <!-- wrapper -->
    <div class="container">
        @yield('content')
    </div>
    <!-- end wrapper -->

    <!-- footer -->
    @include('footer')
    <!-- end footer -->
    </body>
</html>