@extends('layout.NRIChallenge')

@section('title', 'NRI Challenge')

@section('navbar')
    @parent

    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">NRI Challenge</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Services<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1</a></li>
          <li><a href="#">Page 2</a></li>
          <li><a href="#">Page 3</a></li>
        </ul>
      </li>
      <li><a href="#">Contact Us</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>
@endsection

@section('content')
    <header class="bg-image-full img-responsive" style="background-image: url('Auction.jpg');">
    </header>
        <div id="wrap">
        <div class="container">
            <div class="row para">

                <form class="form-horizontal" action="functions.php" method="post" name="upload_excel" enctype="multipart/form-data">  
                      
                      <h1 style="text-align: center;">NRI Challenge</h1>
                      <h3 style="text-align: center;">Please select a csv file to upload</h3>
                      <p>To better gauge your skills as a web developer, we would like you to complete the following challenge. This will help the interviewers assess your strengths, and frame the conversation through the interview process. Take as much time as you need, however we ask that you not spend more than a few hours.</p>
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Save</button>
                            </div>
                        </div>
                </form>

            </div>
            <?php
               get_all_records();
            ?>
        </div>
    </div>
<!-- Footer -->
    <footer class="bg-inverse" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                <small>Copyright NRI Global Inc. 2015. NRIGlobalInc.com<br />
                All Rights Reserved.</small> 
                </div>

                <div class="col-md-4">
                <strong>Follow us</strong><br />
                facebook   twitter   linkedIn
                </div>

                <div class="col-md-4">
                NRI Global<br/>
                1100 - 1st Street SE<br/>
                Suite 501<br/>
                Calgary, Alberta<br/>
                T2G 1B1, Canada<br/>
                Phone: 905-790-2828<br/>
                Fax: 800-771-9871
                </div>
            </div>
        </div>
        <!-- /.container -->
   </footer>
@endsection