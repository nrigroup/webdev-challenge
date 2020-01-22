<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>NRI Web Development Challenge</title>
    <meta name="keywords" content="lots auction NRI" />
    <meta name="description" content="NRI Won Auction Lots" />
    <link href="{{mix('css/app.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
</head>

<nav class="navbar navbar-expand-md justify-content-center bg-light">

    <!-- Links -->
    <ul class="navbar-nav ">
        <li class="navbar-text rightstrong">NRI Webdev Challenge</li>
        <li class="nav-item ">
            <a class="nav-link {{ Request::path()==='/' || Request::path()==='lots' ?  'current_page_item' : ''}}"
                href="/" accesskey="1" title="Our Won Lots">Our Won Lots</a></li>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{ Request::path()==='lots/upload' ?  'current_page_item' : ''}}" href="/lots/upload"
                accesskey="3" title="Upload Lots">Upload Lots</a></li>
        </li>
        <li class="nav-item  ">
            <a class="nav-link {{ Request::path()==='lots/create' ?  'current_page_item' : ''}}" href="/lots/create"
                accesskey="4" title="Create">Create</a></li>
        </li>

        <li class="nav-item ">
            <a class="nav-link {{ Request::path()==='lots/report' ?  'current_page_item' : ''}}" href="/lots/report"
                accesskey="5" title="Report">Report</a></li>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{ Request::path()==='lots/about' ?  'current_page_item' : ''}}" href="/lots/about"
                accesskey="6" title="About">About</a></li>
        </li>
    </ul>

</nav>

@yield ('content')

<script src="/js/app.js"></script>
<script src="/js/main.js"></script>

</body>

</html>
