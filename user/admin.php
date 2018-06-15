<?php
include("../login/auth.php"); //include auth.php file on all secure pages
require '../login/db.php';
$session=$_SESSION['username'];
$id = $_SESSION['id'];
if ($_SESSION['priv'] < 1) {
  header('location: account.php?topic=technology');
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin | <?php echo $_SESSION['fname']; ?></title>
    <?php include '../bootstrap.php'; ?>

    <link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="user.css" media="screen" title="no title" charset="utf-8">
    <style media="screen">

      td.consider span {
        cursor: pointer;
        font-size: 20px;
        color: green;
      }
      td.ignore span {
        cursor: pointer;
        font-size: 20px;
        color: red;
      }
      h4, p {
        color: #f4511e;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <?php include 'nav.php'; ?>
    <br><br><br>
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h4>Topic Suggestions</h4>
          <div class="" id="sugg">

          </div>
        </div>
        <div class="col-sm-6">
          <h4>Topics</h4>
          <div class="" id="topics">

          </div>
        </div>
      </div>
    </div>





   <script type="text/javascript">
     load_sugg();
     load_topics();

     function load_sugg() {
       $.post("admin_data.php",{sugg:1},function(data) {

         $('#sugg').html(data);
       });
     }

     function load_topics() {
       $.post("admin_data.php",{topic:1},function(data) {

         $('#topics').html(data);
       });
     }


   </script>

  </body>
</html>
