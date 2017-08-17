
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome {{Auth::user()->name}}</title>

    <link href="{{ URL::asset('db/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('db/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('db/css/styles.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('db/css/animate.css') }}" rel="stylesheet">


    <!--Icons-->
    <script src="db/js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="{{ URL::asset('db/js/lumino.glyphs.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="{{ URL::asset('db/js/html5shiv.js') }}"></script>
    <script src="{{ URL::asset('db/js/respond.min.js') }}"></script>
    <![endif]-->


    <?php

        $getData=DB::Table('data')->get();

    ?>

</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>NRI</span> Global</a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> {{Auth::user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">

                        <li><a href="{{asset('/logout')}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div><!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li><a href="{{asset('/')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
        <li class="active"><a href="#"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Show Data</a></li>

    </ul>

</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div><!--/.row-->




    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">


                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Lot Title</th>
                        <th>Lot Location</th>
                        <th>Lot Condition</th>
                        <th>Pre-Tax Amount</th>
                        <th>Tax Name</th>
                        <th>Tax Amount</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($getData as $listData)
                    <tr>
                        <td>{{$listData->date}}</td>
                        <td>{{$listData->category}}</td>
                        <td>{{$listData->lotTitle}}</td>
                        <td>{{$listData->lotLocation}}</td>
                        <td>{{$listData->lotCondition}}</td>
                        <td>{{$listData->preTax}}</td>
                        <td>{{$listData->taxName}}</td>
                        <td>{{$listData->taxAmount}}</td>

                    </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div><!--/.row-->


</div>	<!--/.main-->

<script src="{{URL::asset('db/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{URL::asset('db/js/bootstrap.min.js')}}"></script>
<!--
<script src="{{URL::asset('db/js/chart.min.js')}}"></script>
<script src="{{URL::asset('db/js/chart-data.js')}}"></script>
<script src="{{URL::asset('db/js/easypiechart.js')}}"></script>
<script src="{{URL::asset('db/js/easypiechart-data.js')}}"></script>

<script>
    $('#calendar').datepicker({
    });

    !function ($) {
        $(document).on("click","ul.nav li.parent > a > span.icon", function(){
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>
</body>

</html>
