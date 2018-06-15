<?php
include("../login/auth.php");
require '../login/db.php';
?>
<style media="screen">
  .for_comment_display {
    max-height: 350px;
    overflow-x: hidden;
    overflow-y: scroll;
  }
  div.for_comment_display::-webkit-scrollbar {

    width: 5px;
  }
  div.for_comment_display::-webkit-scrollbar-thumb {

    border-radius: 5px;
    background-color: #ccccb3;
  }
</style>
<?php
$id = $_SESSION['id'];



if (isset($_POST['initial_post'])) {
  $more = $_POST['more'];
  $topic = $_POST['topic'];
  $postquery="SELECT * FROM post INNER JOIN users ON post.id=users.id WHERE topic = '$topic' ORDER BY post.postId DESC LIMIT 0,$more";
  $postresult=mysqli_query($connection,$postquery) or die(mysqli_error($connection));
  $postrow=mysqli_fetch_array($postresult);


}

if (isset($_POST['post_notif'])) {
  $postId = $_POST['postId'];
  $topic = $_POST['topic'];
  $commentId = $_POST['commentId'];
  $postquery="SELECT * FROM post INNER JOIN users ON post.id=users.id WHERE postId = $postId";
  $postresult=mysqli_query($connection,$postquery) or die(mysqli_error($connection));
  $postrow=mysqli_fetch_array($postresult);

if ($postresult) {
  $q = "UPDATE postcomments SET notification_read = 1 WHERE commentId = $commentId";
  $qr = mysqli_query($connection,$q) or die(mysqli_error($connection));
}



}
if (isset($_POST['like_notif'])) {
  $postId = $_POST['postId'];
  $topic = $_POST['topic'];
  $likeId = $_POST['likeId'];
  $postquery="SELECT * FROM post INNER JOIN users ON post.id=users.id WHERE postId = $postId";
  $postresult=mysqli_query($connection,$postquery) or die(mysqli_error($connection));
  $postrow=mysqli_fetch_array($postresult);

if ($postresult) {
  $q = "UPDATE likes SET like_read = 1 WHERE likeId = $likeId";
  $qr = mysqli_query($connection,$q) or die(mysqli_error($connection));
}



}
$postquery2="SELECT * FROM post INNER JOIN users ON post.id=users.id WHERE topic = '$topic'";
$postresult2=mysqli_query($connection,$postquery2) or die(mysqli_error($connection));
$num = mysqli_num_rows($postresult2);

$currentUser=$postrow["username"];
if ($num != 0) {
  do { //STARTS A LOOP FOR DISPLAYING POSTS
    ?>

    <div class="well" id="post_delete_success<?php echo $postrow['postId'] ?>">

      <div class="identity" style="margin-left: 20px;">
          <?php
          $iddiscovered = $postrow['id'];

          $dpicquery="SELECT displayPic FROM displayPic WHERE id='$iddiscovered'";
          $foundhere=mysqli_query($connection,$dpicquery);
          $tigerfound=mysqli_fetch_array($foundhere);
           ?>

             <img class="img-circle" src="displayPic/<?php echo $tigerfound['displayPic'] ?>" alt="you" width="50" height="50" />


             <div class="">
               <span><strong><?php echo $postrow['firstName']." ".$postrow['lastName']; ?></strong></span>
               <br>
               <span style="font-size:12px; color: #adad85">
                 <?php
                 $time_ago = $postrow['time'];
                 include 'timer.php';
                  ?>
               </span>
             </div>

  <span class=""></span>

  <span class="dropdown pull-right">
    <span class="beforepriv priv<?php echo $postrow['id'] ?> dropdown-toggle glyphicon glyphicon-option-horizontal" data-toggle="dropdown" style="cursor:pointer"></span>
    <ul class="dropdown-menu">
      <li><a href="#" onclick="delete<?php echo $postrow['postId']; ?>()">Delete this post</a></li>
    </ul>

    <script type="text/javascript">

    function delete<?php echo $postrow['postId']; ?>() {


      $(document).ready(function(){


          $.post("deletepost.php", //Required URL of the page on server
          { // Data Sending With Request To Server

            vid: <?php echo $postrow['postId']; ?>

          },
          function(response,status){ // Required Callback Function
            //alert(status+response);
            load_posts();
          //$("#form")[0].reset();
          });




      });

    }


    </script>


  </span>

      </div><!--dp and name close-->
  <hr>
    <div class="" style="margin-left: 20px;">

      <?php
      $postid = $postrow['postId'];
      $_SESSION['idpostcrev'] = $postid;
       ?>

      <div class="posted">

          <?php
          echo $postrow['post']; //the real post
          $userpostid = $postrow['id'];
          $postida = $postid + 1;
          ?>


      </div>
      <hr>
      <div class="reaction row">

  <?php
  //find the number of comments per post
  if ($postid != null) {
    $counterq = "SELECT COUNT(*) FROM postcomments WHERE postId = $postid";
    $counterresult = mysqli_query($connection,$counterq);
    $counterrowresult = mysqli_fetch_array($counterresult);
    $num_of_comm = $counterrowresult[0];}

   ?>
   <span class="col-sm-6">
     <?php
     $querylk = "SELECT * FROM likes INNER JOIN users ON likes.liker = users.id WHERE likes.postId = '$postid'";
     $resqlk = mysqli_query($connection,$querylk) or die(mysqli_error($connection));
     $numlikes = mysqli_num_rows($resqlk);



      ?>
      <script type="text/javascript">
      number_of_likes<?php echo $postid ?>();
      function number_of_likes<?php echo $postid ?>(){

        $.ajax({
          url	:	"likes.php",
          method	:	"POST",
          data	:	{
           number_of_likes: 1,
           postid: <?php echo $postid ?>
         },
          success	:	function(data){
            $("#total_likes<?php echo $postid ?>").html(data);
          }
        })

      }

      number_of_comments<?php echo $postid ?>();
      function number_of_comments<?php echo $postid ?>(){

        $.ajax({
          url	:	"likes.php",
          method	:	"POST",
          data	:	{
           number_of_comments: 1,
           postid: <?php echo $postid ?>
         },
          success	:	function(data){
            $("#total_comments<?php echo $postid ?>").html(data);
          }
        })

      }
      </script>
      <span class="dropdown">
        <span class="dropdown-toggle" style="cursor: pointer" onclick="like_or_unlike<?php echo $postid ?>();" data-toggle="dropdown" id="total_likes<?php echo $postid ?>"></span>
        <span class="dropdown-menu likesmenu">
          <h5>People who like this</h5>

          <script type="text/javascript">

          function like_or_unlike<?php echo $postid ?>(){

            $.ajax({
              url	:	"like_or_unlike.php",
              method	:	"POST",
              data	:	{
               like_or_unlike: 1,
               postid: <?php echo $postid ?>
             },
              success	:	function(data){
                $("#p_like<?php echo $postid ?>").html(data);
              }
            })

          }
          </script>

          <span id="p_like<?php echo $postid ?>">
          </span>

        </span>
      </span>
     <span> . </span>
     <span style="cursor: pointer" class="" onclick="loadcomments<?php echo $postid ?>()" data-toggle="collapse" id="total_comments<?php echo $postid ?>" data-target="#<?php echo $postida ?>"></span>

   </span>

   <span class="thecomment col-sm-6">
     <a style="cursor: pointer" data-toggle="collapse" onclick="loadcomments<?php echo $postid ?>()" data-target="#<?php echo $postida ?>">
       <span class="glyphicon glyphicon-comment">Comment</span>

     </a><!--<span class="badge"> </span>-->
     <span> . </span>
     <?php
     $queryunlk = "SELECT * FROM likes WHERE postId = '$postid' AND liker = '$id'";
     $resqunlk = mysqli_query($connection,$queryunlk) or die(mysqli_error($connection));
     $arrayunlk = mysqli_fetch_array($resqunlk);
     $numunlike = mysqli_num_rows($resqunlk);
     if ($numunlike > 0) {
       echo '<a style="cursor: pointer" id="'.$postid.'like'.'" class=""><span class="glyphicon glyphicon-thumbs-down"></span> Unlike</a>';
    } else {
       echo '<a style="cursor: pointer" id="'.$postid.'like'.'" class=""><span class="glyphicon glyphicon-thumbs-up"></span> Like</a>';
  }
      ?>

     <script type="text/javascript">
     unlike<?php echo $postid.'unlike' ?>();
   	function unlike<?php echo $postid.'unlike' ?>(){
      $("#<?php echo $postid.'unlike' ?>").click(function(){
   		$.ajax({
   			url	:	"unlike.php",
   			method	:	"POST",
   			data	:	{
          postidcarrier: <?php echo $postid; ?>,
          current: <?php echo $numlikes; ?>,
        },
   			success	:	function(data){
  number_of_likes<?php echo $postid ?>();
   			}
   		})
       });
   	}


    like<?php echo $postid.'like' ?>();
    function like<?php echo $postid.'like' ?>(){
     $("#<?php echo $postid.'like' ?>").click(function(){
     $.ajax({
       url	:	"like.php",
       method	:	"POST",
       data	:	{
         postidcarrier: <?php echo $postid; ?>,
         current: <?php echo $numlikes; ?>,
       },
       success	:	function(data){
         $("#<?php echo $postid.'like' ?>").html(data);
  number_of_likes<?php echo $postid ?>();
       }
     })
      });
    }



     </script>




   </span>

         <br><br>

        <div class="collapse" id="<?php echo $postida ?>">

          <div class="">
            <form name="" id="<?php echo $postid.'formed' ?>" action="" method="post">
              <!--
              <div class="row">
                <div class="col-sm-10">
                  <textarea name="reply" id="<?php echo $postid.'reply' ?>" rows="1" cols="30" class="form-control" placeholder="Write your reply here..." style="border-radius:5px;" required=""></textarea>
                  <input type="text" id="<?php echo $postid.'idcar' ?>" name="idcarrier" value="<?php echo $postid?>" hidden="hidden" />
                </div>
                <div class="col-sm-2">
                  <button type="button" style="font-size:20px" class="btn btn-default btn-sm" id="<?php echo $postid.'btnrep' ?>"><span class="glyphicon glyphicon-send"></span></button>

                </div>
              </div>
  -->
  <div class="input-group">
      <!--<input type="text" class="form-control" placeholder="Search">-->
      <textarea name="reply" id="<?php echo $postid.'reply' ?>" rows="1" cols="30" class="form-control" placeholder="Write your reply here..." style="border-radius:5px;" required=""></textarea>
      <input type="text" id="<?php echo $postid.'idcar' ?>" name="idcarrier" value="<?php echo $postid?>" hidden="hidden" />

      <div class="input-group-btn">
        <button type="button" class="btn btn-default" id="<?php echo $postid.'btnrep' ?>">
          <span class="glyphicon glyphicon-send"></span>
        </button>

      </div>
    </div>

            </form>
            <hr>
            <script type="text/javascript">

            $("#<?php echo $postid.'btnrep' ?>").click(function(){

              var reply = $("#<?php echo $postid.'reply' ?>").val();
              var idcarrier = $("#<?php echo $postid.'idcar' ?>").val();


          			$.ajax({
          			url		:	"deletereply.php",
          			method	:	"POST",
          			data	:	{addrep:1,reply:reply,
                idcarrier: <?php echo $postid; ?>},
          			success	:	function(){
                document.getElementById('<?php echo $postid.'formed' ?>').reset();

                  number_of_comments<?php echo $postid ?>();
                  loadcomments<?php echo $postid ?>();

          				//$("#<?php //echo $postid.'fordisp' ?>").html(data);

          			}
          		})

          	})

                  setInterval(number_of_comments<?php echo $postid ?>,1000);
                  setInterval(number_of_likes<?php echo $postid ?>,1000);


            </script>

          </div>

        <!--Comments modal-->


        <div class="loader l_comm">

        </div>
        <div class="for_comment_display" id="<?php echo $postid.'fordisp' ?>">

        </div><!--fordisplay close-->

        <script type="text/javascript">
        //setInterval(loadcomments<?php echo $postid ?>,3000);

        function loadcomments<?php echo $postid ?>() {
          $('.l_comm').show();


          var mm = 10;//parseInt(num);

          $.ajax({
            url : "tg.php",
            method : "POST",
            data : {
              to: mm,
              postid: <?php echo $postid ?>
            },
            success : function(data){
              $("#<?php echo $postid.'fordisp' ?>").html(data);
              var num_of_comm = <?php echo $num_of_comm; ?>;
              $('.l_comm').hide();

              if (num_of_comm < 11) {
                document.getElementById('loadmore<?php echo $postid ?>').style.display = "none";
              }
            }
          })
        }

        function load_more_comments<?php echo $postid ?>() {
          var num = document.getElementById('load_more_comments<?php echo $postid ?>').value;
          var mm = parseInt(num);
          var num_of_comm = <?php echo $num_of_comm; ?>;



          $.ajax({
            url : "tg.php",
            method : "POST",
            data : {
              to: mm,
              postid: <?php echo $postid ?>
            },
            success : function(data){
              $("#<?php echo $postid.'fordisp' ?>").html(data);
              document.getElementById('load_more_comments<?php echo $postid ?>').value = mm + 10;

              if (mm >= num_of_comm) {
                document.getElementById('loadmore<?php echo $postid ?>').style.display = "none";
              }

            }
          })
        }

        </script>
      </div>
  </div>
    </div><!--post column close-->


  </div><!--post row closed-->

    <?php
  }

  while ($postrow=mysqli_fetch_array($postresult));

} else if ($topic == "All topics") {
  ?>
  <h5 class="well">
    Select a topic of your interest below.
    If you can not find one, just suggest it.

  </h5>
  <div class="jumbotron text-center">

    <?php
    $change_t = "SELECT name, credit,firstName FROM topics INNER JOIN users ON topics.credit = users.id ORDER BY name";
    $change_r = mysqli_query($connection,$change_t);
    while ($change_a = mysqli_fetch_array($change_r)) {
      echo '
      <span class="reaction">
        <a href="account.php?topic='.$change_a["name"].'" title="Topic credits: '.$change_a["firstName"].'">'.$change_a["name"].'</a>
      </span>
      <br>
      ';
    }
     ?>
  </div>
  <?php
} else {
  ?>
  <div class="well text-center" style="color:#f4511e">
    <p>No posts yet for this category, <?php echo $topic; ?>. Be the first to <span>post</span>.</p>

  </div>
  <?php
}


 ?>
