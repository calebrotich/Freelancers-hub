<?php
//Process the above form
include("../login/auth.php");
require '../login/db.php';
$loggedin = $_SESSION['id'];

$postreplypro = $_POST['reply'];
$postidagain = $_POST['idcarrier'];
$q = "INSERT INTO postcomments(comment,postId,id) VALUES('$postreplypro','$postidagain','$loggedin')";
$qresult = mysqli_query($connection,$q) or die(mysqli_error($connection));

  $commentquery = "SELECT * FROM postcomments WHERE postId ='$postidagain' ORDER BY commentId DESC";
  $commentresult = mysqli_query($connection,$commentquery);

   while ($commentrow = mysqli_fetch_array($commentresult)) { //STARTS A LOOP FOR DISPLAYING COMMENTS

    $finalize = $commentrow['id'];
    if ($finalize > 0) {//if a comment is available

      $commentpic = "SELECT displayPic FROM displayPic WHERE id = '$finalize'";
      $commentresultpic = mysqli_query($connection,$commentpic) or die(mysqli_error());
      $commentrowpic = mysqli_fetch_array($commentresultpic);

           echo '
           <div class="">
             <div class="row">
               <div class="col-sm-2">';

                 $queryForComments = "SELECT * from users WHERE id='$finalize'";
                 $resultForComments = mysqli_query($connection,$queryForComments);
                 $rowForComments = mysqli_fetch_array($resultForComments);
                  echo '
                 <img class="img-circle" src="displaypic/'.$commentrowpic['displayPic'].'" alt="" width="40" height="40"/>
               </div>
               <div class="col-sm-10">'
                 .$commentrow['comment'].
                 '
<br>
               <b style="font-size:11px;color:#f4511e">'.$rowForComments['firstName'].' '.$rowForComments['lastName'].'</b> |

               <span style="font-size:11px;color:#f4511e">';

                 $time_ago = $commentrow['time'];

                 include 'timer.php';

           echo '
           </span>
           <span class="beforepriv priv'.$commentrow['id'].'">
                |
               <a href="account.php?page=10&topic=technology" id="'.$commentrow['commentId'].'" style="cursor:pointer;margin-bottom:0;font-size:11px">Delete</a>
               </span>
</div>
             </div>
           </div>
           <hr>
           ';


           echo '

           <script type="text/javascript">

           $(document).ready(function(){
             $("#<?php echo $commentrow[\'commentId\'] ?>").click(function(){
                 alert("done");
             });
         });
           </script>

           ';

  }
  else {
  echo '
  <div class="well">
  <i>No Comments yet...</i>
  </div>
  ';


  }

  }

 ?>
