<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        @section('title')
        Refined Data Live Events
        @show
    </title>

    <!--  Mobile Viewport Fix -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- This is the traditional favicon.
     - size: 16x16 or 32x32
     - transparency is OK
     - see wikipedia for info on browser support: http://mky.be/favicon/ -->
    <link rel="shortcut icon" href="{{{ asset('favicon.ico') }}}">

    <!-- The styles -->
    {{ HTML::style('themes/sbadmin2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
    {{ HTML::style('themes/sbadmin2/bower_components/metisMenu/dist/metisMenu.min.css') }}
    @section('additionalstyles')
    @show
    {{ HTML::style('themes/sbadmin2/dist/css/sb-admin-2.css') }}
    {{ HTML::style('themes/sbadmin2/bower_components/font-awesome/css/font-awesome.min.css') }}

    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
@section('body')
<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url( 'rdsadmin' ) }}">
                    @section('headline')
                    Connect 2 Everything RDS Admin
                    @show
                </a>
            </div>
            <!-- /.navbar-header -->
		<!-- topmenu -->
                    @include('rdsadmin.topmenu')
                    <!-- ./ topmenu -->
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <!-- side menu -->
                    @include('rdsadmin.sidemenu')
                    <!-- ./ sidemenu -->                    
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    @section('heading')
                     <div class="col-lg-12">
                        <h1 class="page-header"></h1>
                    </div>
                    @show
@section('content')
@show
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


@show


<!-- external javascript -->
{{ HTML::script('themes/sbadmin2/bower_components/jquery/dist/jquery.min.js') }}
{{ HTML::script('themes/sbadmin2/bower_components/bootstrap/dist/js/bootstrap.min.js') }}
{{ HTML::script('themes/sbadmin2/bower_components/metisMenu/dist/metisMenu.min.js') }}

@section('additionaljavascriptincludes')
@show

{{ HTML::script('themes/sbadmin2/dist/js/sb-admin-2.js') }}

@section('additionaljavascript')
@show

@yield('scripts')

</body>

</html>
