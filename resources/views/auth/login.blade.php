
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NRI Global Challenge</title>

    <!-- Bootstrap -->
    <script src="js/pace.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:700,400|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link href="css/theme-loading-bar.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container" id="container" style="display:none;">
    <header>
        <!-- Main comapny header -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand top-navbar-brand" href="/"><span class="text-primary" style="font-size:0.80em">NRI </span> <span style="font-size:0.50em">Global<span></a>
                </div>
            </div>
        </nav>
    </header>
    <section id="form" class="animated fadeInDown">
        <div class="container">
            <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel white-alpha-90" >
                    <div class="panel-heading">
                        <div class="panel-title text-center"><h2>Sign In to <span class="text-primary">NRI</span></h2></div>
                    </div>
                    <div class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Login
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
            <div class="container text-center">
                <div class="footer-content">
                    Haven't registered yet? <a href="/register" class="btn btn-primary"> Register Here </a>
                </div>
            </div><!-- /.container-fluid -->
        </nav>
    </footer>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>

<script>
    Pace.on('hide', function(){
        $("#container").fadeIn('1000');
        $.backstretch([
            "images/login/login_bg_1.jpg",
            "images/login/login_bg_2.jpg"
        ], {duration: 5000, fade: 1000});
    });

</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-53918379-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>







