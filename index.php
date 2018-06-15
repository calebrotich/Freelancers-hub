<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME | JOBS forum</title>
     <?php include 'bootstrap.php'; ?>
    <link rel="stylesheet" href="css/navbar.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="css/main.css" media="screen" title="no title" charset="utf-8">

  </head>
  <body id="body">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <p>
        <span><img class="navbar-brand icon" src="images/icon.jpg" alt="" />
        <a href="#" class="navbar-brand"></span>Freelancers' Hub<br><span class="motto">Expand your Horizon</span></a>
      </p>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span>  HOME</a></li>
        <li><a href="login/reg.php"><span class="glyphicon glyphicon-pencil"></span>  REGISTER</a></li>

<li><a href="user/account.php?topic=All topics"><span class="glyphicon glyphicon-user"></span>  ACCOUNT</a></li>


        <li><a href="login/login.php"><span class="glyphicon glyphicon-log-in"></span>  LOGIN</a></li>
      </ul>
    </div>
  </div>
</nav>


  <div class="container-fluid face" >
  <img class="container-fluid faceimage" id="face" src="images/preflens.jpg" alt="" />
<div class="texttop text-center">
  <P><h1>Welcome to Freelancers' Hub</h1></P>
  <h4>Grow your network</h4>
</div>
  <div class="imagetop">

    <a class="btn btn-default btn-lg" href="login/reg.php">REGISTER</a>
    <a class="btn btn-default btn-lg" href="login/login.php">LOGIN</a>
  </div>
  </div>

<!-- <div class="container face_small">
  <h3>WELCOME TO Freelancers' Hub</h3>
  <a class="btn btn-default btn-lg" href="login/reg.php">REGISTER</a>
  <a class="btn btn-default btn-lg" href="login/login.php">LOGIN</a>
</div> -->
<hr>
<div class="container dopanels text-center">

  <h4 class="text-center title">WHAT WE DO</h4>
  <span class="descriptor">Know and interact with our specialities</span>
  <div class="row">
    <div class="col-sm-4">
      <div class="panel">
        <div class="panel-heading">
          <h4>JOB LINKS</h4>
        </div>
        <div class="panel-body">
          <span class="glyphicon gly glyphicon-briefcase"></span>
          <p>Job posting</p>
          <p>Job searching</p>
          <p>Expert discussions</p>
        </div>
        <div class="panel-footer">
          <a class="btn btn-danger" href="login/reg.php">START WORKING</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="panel">
        <div class="panel-heading">
        <h4>ADVERTISEMENTS</h4>
        </div>
        <div class="panel-body">
<span class="glyphicon gly glyphicon-bullhorn"></span>
<p>
  Business Adverts
</p>
<p>
  Personal Adverts
</p>
<p>
  Company adverts
</p>
        </div>
        <div class="panel-footer">
          <a class="btn btn-danger" href="login/reg.php">BE KNOWN</a>
        </div>
      </div>
      </div>

    <div class="col-sm-4">
      <div class="panel">
        <div class="panel-heading">
          <h4>CONNECTIONS</h4>
        </div>
        <div class="panel-body">
          <span class="glyphicon gly glyphicon-circle-arrow-up"></span>
          <p>
            Through Social platform
          </p>
          <p>
            Interactive forum
          </p>
          <p>
            Topic discussions
          </p>
        </div>
        <div class="panel-footer">
          <a class="btn btn-danger" href="login/reg.php">START GROWING</a>
        </div>
      </div>
      </div>
    </div>
    </div>
    <hr>

<div class="container row say">
  <h4 class="text-center title">PEOPLE'S SAY</h4>
  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
      <h4>"Reviews will appear here"<br><span style="font-style:normal;">First reviewer</span></h4>
      </div>
      <div class="item">
        <h4>"Reviews will appear here"<br><span style="font-style:normal;">second reviewer</span></h4>
      </div>
      <div class="item">
        <h4>"Reviews will appear here"<br><span style="font-style:normal;">Third reviewer</span></h4>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

</div>

<hr>

    <div class="container" id="contact">
      <h4 class="text-center title">CONTACT</h4>
      <div class="row test">
        <div class="col-md-4">
          <h4 class="title">Contact Freelancers' Hub</h4>
          <p><span class="glyphicon glyphicon-map-marker title"></span> Nyeri, Kenya</p>
          <p><span class="glyphicon glyphicon-phone title"></span> Phone: +254 732 094 466</p>
        <!--  <p><span class="glyphicon glyphicon-envelope"></span>Email: mail@mail.com</p>-->
        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-sm-6 form-group">
              <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
            </div>
            <div class="col-sm-6 form-group">
              <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
            </div>
          </div>
          <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
          <br>
          <div class="row">
            <div class="col-md-12 form-group">
              <button class="btn pull-right" type="submit">Send</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--CAROUSEL-->
    <!--<div class="container text-center">
      <h3>WHAT PEOPLE SAY</h3>
      <div id="myCarousel" class="carousel-slide" data-ride="carousel">



<div class="carousel-inner" role="listbox">
  <div class="item active">
    <blockquote>
      My friend has changed profile <br>
      <span>Duncan, Engineer</span>
    </blockquote>
  </div>
  <div class="item">
    <blockquote>
      It is the next big thing <br>
      <span>Jane, Marketer</span>
    </blockquote>
  </div>
  <div class="item">
    <blockquote>
      It is quite beneficial <br>
      <span>Ivy, Computer scientist</span>
    </blockquote>
  </div>
</div>

      </div>
    </div>
    <!--/CAROUSEL-->


<!--
    <hr>
  <div class="container text-center">
    <h3>SUBSCRIPTION PLAN</h3>
    <span class="descriptor">Choose a plan that works best for you</span>
<div class="row">
  <div class="col-sm-4">
    <div class="panel panel-default panbasic">
      <div class="panel-heading basic">
<h4>BASIC</h4>
      </div>
      <div class="panel-body">

      </div>
      <div class="panel-footer">
        <p style="color: #000; font-size:18px;"><span class="glyphicon glyp glyphicon-tag"></span>FREE</p>
        <a class="btn btn-danger" href="login/reg.php">REGISTER</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="panel panel-default pangolden">
      <div class="panel-heading golden">
<h4>GOLDEN</h4>
      </div>
      <div class="panel-body">

      </div>
      <div class="panel-footer">
        <p style="color: #000; font-size:18px;"><span class="glyphicon glyp glyphicon-tag"></span>Kes. 5000</p>
        <a class="btn btn-danger" href="login/reg.php">REGISTER</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="panel panel-default pansilver">
      <div class="panel-heading silver">
<h4>SILVER</h4>
      </div>
      <div class="panel-body">

      </div>
      <div class="panel-footer">
        <p style="color: #000; font-size:18px;"><span class="glyphicon glyp glyphicon-tag"></span>Kes. 2500</p>
        <a class="btn btn-danger" href="login/reg.php">REGISTER</a>
      </div>
    </div>
  </div>
</div>


  </div>
-->
  <a href="#body" class="backtop"><span title="Back To Top" class="glyphicon glyphicon-arrow-up"></span></a>


  <div class="container-fluid">
    <?php
    include 'footer.php';
     ?>
  </div>
  <script type="text/javascript">
  function myTimer() {
      var d = new Date();
      document.getElementById("timer").innerHTML = d.toLocaleTimeString();


  }
  </script>
  <script type="text/javascript">
  $(document).ready(function() {
    var offset = 220;
    var duration = 1000;
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.backtop').fadeIn(duration);
        } else {
            $('.backtop').fadeOut(duration);
        }
    });

    $('.backtop').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
  });
  </script>

  </body>
</html>
