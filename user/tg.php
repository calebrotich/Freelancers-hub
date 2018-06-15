<?php
include("../login/auth.php"); //include auth.php file on all secure pages
require '../login/db.php';

$postid = $_POST['postid'];
if(isset($_POST['postid'])) {

$to = $_POST['to'];
  $commentquery = "SELECT * FROM postcomments WHERE postId = '$postid' ORDER BY commentId DESC LIMIT 0,$to";
  $commentresult = mysqli_query($connection,$commentquery);
  $commentrow = mysqli_fetch_array($commentresult);



//<!-- COMMENTS -->

do { //STARTS A LOOP FOR DISPLAYING COMMENTS

$finalize = $commentrow['id'];
if ($finalize > 0) {//if a comment is available

  $commentpic = "SELECT displayPic FROM displayPic WHERE id = '$finalize'";
  $commentresultpic = mysqli_query($connection,$commentpic) or die(mysqli_error());
    $commentrowpic = mysqli_fetch_array($commentresultpic);
    $queryForComments = "SELECT * from users WHERE id='$finalize'";
    $resultForComments = mysqli_query($connection,$queryForComments);
    $rowForComments = mysqli_fetch_array($resultForComments);

       echo '

      <div class="">
        <div class="row">
          <div class="col-sm-2">


            <img class="img-circle" src="displaypic/'.$commentrowpic['displayPic'].'" alt="" width="40" height="40"/>
          </div>
          <div class="col-sm-10">
            '.$commentrow['comment'].'
<br>

          <b style=\'font-size:11px;color:#f4511e\'>'.$rowForComments['firstName'].' '.$rowForComments['lastName'].' |</b>



          <span style="font-size:11px;color: #f4511e">


            ';
            $time_ago = $commentrow['time'];
            include "timer.php";
            echo '
         </span>
            <span class="beforepriv priv'.$commentrow['id'].'" style="font-size:11px">
              |
             <a id="'.$commentrow['commentId'].'" onclick="del'.$commentrow['commentId'].'()" value="'.$postid.'" style="cursor:pointer;margin-bottom:0">Delete</a>
             </span>
          </div>

          <script type="text/javascript">

          function del'.$commentrow['commentId'].'() {



            $(document).ready(function(){

              var idd = '.$commentrow['commentId'].'
              var hdd = '.$postid.'

              if (idd == "" || hdd == "") {
                Alert("Something went wrong");

              } else {

                $.post("deletereply.php", //Required URL of the page on server
                { // Data Sending With Request To Server

                  deleterep: 1,
                  carrier: hdd,
                  cid: idd

                },
                function(response,status){ // Required Callback Function
                  number_of_comments'.$postid.'();
                  loadcomments'.$postid.'();

                //$("#form")[0].reset();
                });

              }


            });




          }


          </script>
        </div>
      </div>

<hr>

';
}
else {
echo '
<div class="well">
<i>No Comments yet...</i>
</div>
';
}

} while ($commentrow = mysqli_fetch_array($commentresult));
echo '
<center>

<input type="text" id="load_more_comments'.$postid.'" name="" value="20" hidden="hidden">
<a style="cursor:pointer" id="loadmore'.$postid.'" onclick="load_more_comments'.$postid.'()">Load more...</a>
</center>
';
mysqli_close($connection);
}

?>
<!--/COMMENTS -->
