<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li <?php if(\Request::is('user*')){echo 'class="active"';}?>>
            <a href="/user/">Users</a>
        </li>
        <li <?php if(\Request::is('file*')){echo 'class="active"';}?>>
            <a href="/file/">Files</a>
        </li>
        <li <?php if(\Request::is('category*')){echo 'class="active"';}?>>
            <a href="/category/">Categories</a>
        </li>
        <li <?php if(\Request::is('lot*')){echo 'class="active"';}?>>
            <a href="/lot/">Lots</a>
        </li>
        <li <?php if(\Request::is('tax*')){echo 'class="active"';}?>>
            <a href="/tax/">Taxes</a>
        </li>
    </ul>

</div>
