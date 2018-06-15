<?php
require 'auth.php';
require 'db.php';
$id = $_SESSION['id'];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Freelancers' Hub | Add Photo</title>
    <?php include '../bootstrap.php'; ?>

    <link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="../user/user.css" media="screen" title="no title" charset="utf-8">

    <style media="screen">
      #uploadDiv {

        text-align: center;

      }

     h4 {
       color: #009933;
     }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#dropit" name="button">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#" class="navbar-brand">Freelancers' Hub</a>
        </div>
        <div class="navbar-collapse collapse" id="dropit">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
            <li class="dropdown">
              <a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['fname'] ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <?php



     ?>
     <script type="text/javascript">
     load_dp();
     function load_dp() {
       $.post("uploaddp.php",{load_pic:1},function (picture) {$("#preview").html(picture)});
     }

     </script>
     <div class="container-fluid" style="margin-top:50px">
       <div class="row">

         <div class="col-sm-6">
           <div class="well" id="uploadDiv">
             <p>Select a profile picture</p>
             <form class="" action="" id="photo_sub" method="post" enctype="multipart/form-data">
               <div class="">
                 <label for="upph">
                   <span id="preview"></span>
                 </label>
               </div>

               <input type="file" id="upph" onchange="upload_dp()" accept="image/*" name="file" class="inputfile" value="" required="">
               <label class="btn btn-default sub_button" for="upph" name="photo" value="">Select Image</label>
             </form>
             <script type="text/javascript">
             function upload_dp() {
               if ($('#upph').val() != '') {
                 $('#photo_sub').submit();

               }
             }
               $(document).ready(function (e){
                 $("#photo_sub").on('submit',function (e) {
                   e.preventDefault();
                   $.ajax ({
                     url: "uploaddp.php",
                     type: "POST",
                     data: new FormData(this),
                     contentType: false,
                     processData: false,
                     success: function (data) {

                       load_dp();
                     }
                   });
                 });
               });

             </script>
           </div>
         </div>
         <div class="col-sm-6">
           <div class="well">
             <p>
               Update your details
             </p>
             <form class="" action="skills.php" method="post">
               <div class="form-group">
                 <h4>Describe yourself shortly</h4>
                 <textarea name="desc" id="desc" class="form-control" rows="8" cols="40" placeholder="A short description about yourself. Make it appealing." required=""></textarea>
               </div>
               <hr>
               <div class="form-group">
                 <h4>Indicate your Skills (Separate multiple interests with commas)</h4>
                 <textarea name="skills" id="skills" class="form-control" rows="2" cols="40" placeholder="Enter multiple skills separated by commas ',' e.g. Web developer, data entry, transcription" required=""></textarea>

               </div>
               <hr>
               <div class="form-group">
                 <h4>Indicate your Interests (Separate multiple interests with commas)</h4>
                 <textarea name="interests" id="interests" class="form-control" rows="2" cols="40" placeholder="You can indicate multiple interests separated by commas ',' e.g. Programming, transcription, cooking" required=""></textarea>
               </div>
               <?php
               $auto_q = "SELECT skills, interests, description FROM skills WHERE id = '$id'";
               $auto_r = mysqli_query($connection,$auto_q);
               $auto_a = mysqli_fetch_array($auto_r);
                ?>
       <script type="text/javascript">
             document.getElementById('desc').value = '<?php echo $auto_a['description'] ?>';
             document.getElementById('skills').value = '<?php echo $auto_a['skills'] ?>';
             document.getElementById('interests').value = '<?php echo $auto_a['interests'] ?>';

       </script>
           </div>
           <div class="form-group pull-right">
             <a href="../user/account.php?topic=technology" class="btn btn-default">SKIP</a>
             <input type="submit" class="btn btn-default" name="button" value="SAVE" />
           </div>
         </form>

         </div>

       </div>
     </div>

  </body>
</html>
