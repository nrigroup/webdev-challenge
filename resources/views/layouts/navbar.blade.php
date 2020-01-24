<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{asset('inspinia/img/profile_small.jpg')}}"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">Felipe Pastana</span>
                        <span class="text-muted text-xs block">Web Developer <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                        <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                        <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="active">
                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Auction</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="active"><a href="{{route('auction_index')}}">Import CSV</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
