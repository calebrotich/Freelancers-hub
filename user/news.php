<?php
include '../login/auth.php';
require '../login/db.php';
$id = $_SESSION['id'];
$query = "SELECT * FROM status INNER JOIN news ON status.newId=news.newId WHERE status.id='$id' or status.id='17'";
$newsresult = mysqli_query($connection,$query) or die(mysqli_error($connection));
$newsrow = mysqli_num_rows($newsresult);

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Eagle Lens | News</title>
    <?php include '../bootstrap.php'; ?>

    <link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">

    <style media="screen">
      p, h4 {
        color: #f4511e;
      }
      .well {
        width: 40%;
        margin: auto;
      }
    </style>
  </head>
  <body>
    <?php include 'nav.php'; ?>
    <br><br><br>

    <div class="container">

    </div>
    <div class="jumbotron text-center">
      <p>
        News, Views, Reviews and Interviews
      </p>

      <?php
      if ($newsrow == 0) {
        echo "<div class='text-center'>
        Nothing new<br>
        <a href=''>View all news</a>
        </div>
        ";
      } else {
        while ($newsarray = mysqli_fetch_array($newsresult)) {
            echo "<div class='well text-center'>".
            "<h4>".$newsarray['title']."</h4>".
            $newsarray['news']
            ."</div><br><br>";
          }
        }

       ?>

    </div>

  </body>
</html>
