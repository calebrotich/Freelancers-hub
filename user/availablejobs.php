<?php
require '../login/db.php';
require '../login/auth.php';
$search = $_GET['search'];

$gp = $_GET['page'];
$rp = $gp - 1;
$p = $rp * 5;
$query="SELECT * FROM jobs WHERE jobName LIKE '%$search%' OR type LIKE '%$search%' OR description LIKE '%$search%'
OR qualification LIKE '%$search%' OR reqskills LIKE '%$search%' ORDER BY jobId DESC LIMIT $p,5";
$result=mysqli_query($connection,$query) or die(mysqli_error($connection));


$query2="SELECT * FROM jobs WHERE jobName LIKE '%$search%' OR type LIKE '%$search%' OR description LIKE '%$search%'
OR qualification LIKE '%$search%' OR reqskills LIKE '%$search%'";
$result2=mysqli_query($connection,$query2) or die(mysqli_error($connection));

$rows = mysqli_num_rows($result2);

$query3 = "SELECT * FROM jobs";
$result3 = mysqli_query($connection,$query3) or die(mysqli_error($connection));
$rows2 = mysqli_num_rows($result3);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jobs</title>
    <?php include '../bootstrap.php'; ?>

    <link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="user.css" media="screen" title="no title" charset="utf-8">

<?php
 ?>


    <style media="screen">
    @media only screen and (max-width: 767px) {
      .well {
        width: 100%;
        margin: auto;
      }
      #search {
        width: 100%;
      }
    }
    @media only screen and (min-width: 768px) {
      .well {
        width: 40%;
        margin: auto;
      }
      #search {
        width: 30%;
      }
    }

      .jobname {
        font-size: 20px;
        color: #f4511e;
      }
    h5 {
      text-align: center;
      text-decoration: underline;
    }
    span.av {
      font-size: 20px;
      color: #f4511e;
      cursor: pointer;
      margin: auto;
    }
    p {
      color: blue;
      font-size: 14px;
    }

    #pagination li.active a,#pagination2 li.active a {
      background-color: #f4511e;
      color: white !important;
      border-color: #f4511e;
    }
    .bd<?php echo $_SESSION['id'] ?> {
      display: none;
    }

    </style>

  </head>
  <body>

<?php
$id = $_SESSION['id'];
 include 'nav.php';
 ?>

<br><br><br>
<div class="container">
  <center>
  <form class="form-horizontal" action="" method="get">

    <div class="form-group">
      <div class="input-group" id="search">
        <input type="text" name="page" value="1" hidden="hidden">
        <input type="text" name="search" class="form-control" value="" placeholder="Search jobs">

  <div class="input-group-btn">
    <button type="submit" class="btn btn-default" name="button">
      <span class="glyphicon glyphicon-search"></span>
    </button>
  </div>

      </div>

    </div>
  </form>
  <?php
  if ($search == '') {
    echo $rows.' jobs available' ;
  } elseif ($search !== '') {
    echo $rows.' job(s) available for "'.$search.'"';
  }

  ?>
  <div id="pager">
  <ul class="pagination" id="pagination">

  </ul>
  </div>


    <script type="text/javascript">
    var rows = <?php echo $rows; ?>;
      var pages = Math.ceil(rows/5);

  if (pages > 1) {
    for (var i = 1; i <= pages; i++) {

      var input = document.createElement("input");
      var li = document.createElement("li");
      var a = document.createElement("a");


      a.innerHTML = i;
      a.setAttribute("href","availablejobs.php?page="+i+"&search=<?php echo $search ?>");
      li.setAttribute("id","t"+i);

      li.appendChild(a);
      //document.getElementById('pagination').appendChild(li);
      document.getElementById("pagination").appendChild(li);
    }
  }


      //document.getElementById('pager').innerHTML = pages;
    </script>

  </center>
</div>

<?php

while ($array=mysqli_fetch_array($result)) {
  if ($rows2 == 0) {
    echo "
    <div class='well text-center' id='jobswill'>
    jobs will appear here once posted
    </div>
    ";
    exit();
  }
$r = explode(",",$array['reqskills']);
?>

<script type="text/javascript">
function propose(vl) {

  $.ajax({
          type: 'POST',
          url: 'propose.php',
          data: { jId: vl },
          success: function() {
              alert("done");
          }
      });

}
</script>

<div class="container">
    <div class="well">
      <?php
       $qusers = "SELECT * FROM users WHERE id='$array[4]'";
       $qr=mysqli_query($connection,$qusers) or die(mysqli_error($connection));
       $ar = mysqli_fetch_array($qr);
       $q="SELECT displayPic FROM displayPic WHERE id='$array[4]'";
       $qresult=mysqli_query($connection,$q) or die(mysqli_error($connection));
       $a = mysqli_fetch_array($qresult);
       ?>
      <div class="row">
        <h5>Client Information</h5>
        <div class="col-sm-4">
          <img src="displaypic/<?php echo $a['displayPic'] ?>" class="img-circle" width="50" height="50" alt="" />
        </div>
        <div class="col-sm-8">

          <div>
            <strong>Posted by:</strong>
            <?php echo $ar['firstName']." ".$ar['lastName'] ?>
          </div>
          <strong>Member Since: </strong>
           <?php echo $ar['trn_date'] ?>
           <div>
             <strong>Posted </strong>
             <?php
             $time_ago = $array['time'];
              include 'timer.php';
               ?>
           </div>
        </div>

      </div>
      <hr>
      <h5>Job Information</h5>
      <div class="row">
        <div class="col-xs-4">
          <center title="Duration to finish the job">
          <span class="glyphicon glyphicon-time av"></span>
          <p><?php echo $array['duration']." days"; ?></p>
        </center>
        </div>
        <div class="col-xs-4">
          <center title="Budget for the job">
          <span class="glyphicon glyphicon-briefcase av"></span>
          <p><?php echo "Ksh. ".$array['budget']; ?></p>
        </center>
        </div>
        <div class="col-xs-4">
          <center title="Location of the client">
          <span class="glyphicon glyphicon-map-marker av"></span>
          <p><?php echo $ar['nationality'] ?></p>
        </center>
        </div>
      </div>
      <hr>
      <div class="jobname">

          <?php echo $array['jobName']; ?>
          <span title="Save Job" class="glyphicon glyphicon-heart-empty pull-right av"></span>
      </div>
      <div class="">
        <strong>Details:</strong><br>
        <?php echo $array['description']; ?>
      </div>
      <br>
      <div class="">
        <hr>
        <strong>Required Skills:</strong>
        <?php
        for ($i=0; $i < count($r) ; $i++) {
          echo "<div class='label label-success'>".$r[$i]."</div>";

          echo " ";
        }
         ?>
      </div>
      <br>
      <div class="">

          <strong>Job type: </strong>


          <?php echo "<div class='label label-default'>".$array['type']."</div>"; ?>

      </div>
<br>
      <div class="">

          <strong>Qualification:</strong>


          <?php echo "<div class='label label-info'>".$array['qualification']."</div>" ; ?>

      </div>
      <hr>
      <div class="">
        <strong>Needed: </strong>
        <?php echo "<div class='label label-danger'>".$array['needed']."</div>" ;  ?>

      </div>
      <br>
      <div class="">
        <?php
        $propq = "SELECT * FROM proposal WHERE jobId='$array[0]'";
        $propr = mysqli_query($connection,$propq);
        $proprows = mysqli_num_rows($propr);
         ?>
        <strong>Proposals: </strong>
        <?php echo "<div class='label label-danger'>".$proprows."</div>" ;  ?>
      </div>
      <br>
      <div class="">
        <?php
        $propqh = "SELECT * FROM proposal WHERE jobId='$array[0]' and hired=1";
        $proprh = mysqli_query($connection,$propqh);
        $proprowsh = mysqli_num_rows($proprh);
         ?>
        <strong>Hired: </strong>
        <?php echo "<div class='label label-danger'>".$proprowsh."</div>" ;  ?>
      </div>
      <br>
      <center>
        <form class="" action="send.php" method="post">
          <input type="text" name="jobid" value="<?php echo $array['jobId'] ?>" hidden="">
          <input type="text" name="sender" value="<?php echo $array['id'] ?>" hidden>
          <input type="submit" class="btn btn-danger bd<?php echo $array['id'] ?>" value="BID" name="button" />
        </form>



</center>
    </div>
</div>
<br>
<?php
 }
 ?>
 <center>
   <div id="pager2">
     <ul id="pagination2" class="pagination">
     </ul>
   </div>
 </center>

 <script type="text/javascript">
 var rows = <?php echo $rows; ?>;
   var pages = Math.ceil(rows/5);
/*
   var span = document.createElement("span");
   var spanl = document.createElement("span");
   span.setAttribute("class","glyphicon glyphicon-menu-right");
   spanl.setAttribute("class","glyphicon glyphicon-menu-left");
  document.getElementById("pagination2").appendChild(spanl);
*/
if (pages > 1) {
  for (var i = 1; i <= pages; i++) {

    var input = document.createElement("input");
    var li = document.createElement("li");
    var a = document.createElement("a");



    a.innerHTML = i;
    a.setAttribute("href","availablejobs.php?page="+i+"&search=<?php echo $search ?>");
    li.setAttribute("id","b"+i);


    li.appendChild(a);
    //document.getElementById('pagination').appendChild(li);
    document.getElementById("pagination2").appendChild(li);


  }
}

   //document.getElementById("pagination2").appendChild(span);

   //document.getElementById('pager').innerHTML = pages;
 </script>

<script type="text/javascript">
  document.getElementById('available').className="active";
</script>
<script type="text/javascript">
  document.getElementById('t'+<?php echo $gp; ?>).className="active";
  document.getElementById('b'+<?php echo $gp; ?>).className="active";


</script>
  </body>
</html>
