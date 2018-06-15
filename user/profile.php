 <?php
include '../login/auth.php';
require '../login/db.php';
$sender = $_SESSION['id'];
$id = $_SESSION['profuser'];
$querynm="SELECT * FROM users WHERE id='$id'";
$resultnm=mysqli_query($connection,$querynm);
$rownm=mysqli_fetch_array($resultnm);
$pid = $_SESSION['pid'];

$hireq = "SELECT * FROM proposal WHERE propId = $pid";
$hirer = mysqli_query($connection,$hireq) or die(mysqli_error($connection));
$hirea = mysqli_fetch_array($hirer);
$conf = $hirea['id'];
$hiredg = $hirea['hired'];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Eagle Lens | <?php echo $rownm['firstName']." ".$rownm['lastName']; ?></title>
    <?php include '../bootstrap.php'; ?>

    <link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="user.css" media="screen" title="no title" charset="utf-8">
    <style media="screen">


      div#sidenav::-webkit-scrollbar {
        width: 5px;
      }
      div#sidenav::-webkit-scrollbar-thumb {
        border-radius: 5px;
        background-color: #ccccb3;
      }

    </style>
    <?php
    $query="SELECT displayPic FROM displayPic WHERE id='$id'";
    $result=mysqli_query($connection,$query);
    $row=mysqli_fetch_array($result);
    $pic= $row['displayPic'];
    ?>

    <script type="text/javascript">
    function browser_resize() {
      nav_beh();
      $(function () {
        if (window.innerWidth > 767) {
          var browser_height = (window.innerHeight - 60);
          $('#sidenav, #rightdiv').css('height', browser_height);
          $('#sidenav, #rightdiv').addClass('tab-pane active in');
          $('div.wrapper').addClass('tab-content');
          $('.nav-tabs').css('display','none');

        } else {
          $('#sidenav, #rightdiv').addClass('tab-pane fade');
          $('#sidenav').addClass('tab-pane active fade in');
          $('#rightdiv').removeClass('active');
          $("a[href = '#rightdiv']").parent().removeClass('active');
          $("a[href = '#sidenav']").parent().addClass('active');


          $('div.wrapper').addClass('tab-content');
          $('.nav-tabs').css('display','block');
          $('#sidenav, #rightdiv').css('height', '100%');

        }

      });
    }

    </script>
  </head>
  <body onresize="browser_resize()" onload="browser_resize()">
<?php include 'nav.php'; ?>
<br><br>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#sidenav">Profile</a></li>
  <li><a data-toggle="tab" href="#rightdiv">Chat</a></li>
</ul>
<div class="container-fluid">

  <div class="row wrapper">
    <div class="col-sm-6 text-center" id="sidenav">
      <?php

      if ($conf != $sender && $hiredg == 0) {
        ?>
        <br>
        <form class="" action="hire.php" method="post">
          <input type="text" name="pid" value="<?php echo $pid ?>" hidden="hidden">
          <input type="text" name="status" value="1" hidden="hidden">

          <input type="submit" class="btn btn-danger" name="" value="HIRE <?php echo $rownm['firstName'] ?>">

        </form>
        <?php
      } elseif ($conf != $sender && $hiredg == 1) {
        ?>
        <br><br>
        <form class="" action="hire.php" method="post">
          <input type="text" name="pid" value="<?php echo $pid ?>" hidden="hidden">
          <input type="text" name="status" value="0" hidden="hidden">
          <!--<button class="btn">HIRED <span class="glyphicon glyphicon-ok"></span></button>-->
          <input type="submit" class="btn btn-danger" name="" value="FIRE <?php echo $rownm['firstName'] ?>">
        </form>
        <?php
      }
       elseif ($conf == $sender && $hiredg == 0) {
        echo "<br><p style='color:#f4511e'>You are being interviewed by ".$rownm['firstName']."</p>";
      } else {
        echo "<br><p style='color:#f4511e'>You have been hired by ".$rownm['firstName']."</p>";
      }
       ?>

        <div class="well">
          <p class="title">
            <?php echo $rownm['firstName']."'s Profile" ?>
          </p>
    <?php

    echo $rownm['firstName']." ".$rownm['lastName'];
    ?>

    <div class="" style="position:relative">
     <img title="profile" class="img-circle" src='displayPic/<?php echo $pic ?>'  alt='profile photo' height='100' width='100' style="cursor: pointer" />
    </div>


    <div class="well">
    <?php
    $qs = "SELECT * FROM skills WHERE id = '$id'";
    $res = mysqli_query($connection,$qs) or die(mysqli_error($connection));
    $row = mysqli_num_rows($res);
    $array = mysqli_fetch_array($res);
     ?>
    <p class="title">
      Description
    </p>
    <?php
    if ($row == 0) {
      echo "No description yet <br>
      ";
    } else {
      echo $array['description'];

    }

     ?>
    </div>
    <div class="well">
    <p class="title">
      Skills
    </p>
    <?php
    if ($row == 0) {
      echo "No Listed Skills <br>
      ";

    } else {
      $ss = $array['skills'];
      $ssin = explode(",",$ss);
      for ($i=0; $i < count($ssin) ; $i++) {
        echo $ssin[$i]."<br>";
      }

    }
      ?>
    </div>

          <div class="well">
            <p class="title">
              INTERESTS
    <div class="label label-danger">
    Programming
    </div></br>
    <div class="label label-success">
    Web
    </div></br>
    <div class="label label-default">
    Android
    </div>
            </p>
          </div>
        </div>
      </div>

    <div class="col-sm-6 text-center container" id="rightdiv">

    </div>
    <script type="text/javascript">
    load_chat();
    function load_chat() {
      $('#rightdiv').html('<div>Be patient as your conversation loads...');
      $.post("profile_chat.php",
      {

      },
      function (data) {
        $('#rightdiv').html(data);
        var obj = document.getElementById('rightdiv');
        //obj.scrollTop = obj.scrollHeight;
        $('#rightdiv').animate({scrollTop: obj.scrollHeight},1500);
      }
    );
    }

    </script>
  </div>


</div>

  </body>
</html>
