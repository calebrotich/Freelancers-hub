<script type="text/javascript">
nav_beh();
  function nav_beh() {
    if (window.innerWidth > 767 && window.innerWidth < 992) {
      $(function () {
        $('.navbar-header').css('display','none');
      });
    } else {
      $('.navbar-header').css('display','block');

    }

  }
</script>

  <nav class="navbar navbar-default navbar-fixed-top">
     <div class="container">
       <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#dropit" name="button">
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="../index.php">EAGLE LENS</a>
       </div>
  <div class="navbar-collapse collapse" id="dropit">
  <ul class="nav navbar-nav navbar-right">
   <li id="home"><a href="../index.php"><span class="glyphicon glyphicon-home navs"></span> Home</a></li>

   <li class="dropdown" id="notif_drop" style="display:none">
     <?php
     $q_not = "SELECT post.postId, post, topic, commentId, comment, postcomments.id, notification_read, postcomments.time FROM postcomments INNER JOIN post ON postcomments.postId = post.postId
      WHERE post.id = '$id' AND postcomments.id != '$id' AND postcomments.notification_read = 0 ORDER BY postcomments.time DESC";
     $r_not = mysqli_query($connection, $q_not);

     $q_like = "SELECT likeId, liker, topic, likes.postId, likes.time FROM likes INNER JOIN post ON likes.postId = post.postId WHERE post.id = '$id' AND likes.liker != '$id' AND like_read = 0";
     $r_like = mysqli_query($connection, $q_like) or die(mysqli_error($connection));

     $like_row = mysqli_num_rows($r_like);
     $comm_row = mysqli_num_rows($r_not);
      $r_row = $like_row + $comm_row;


       ?>


     <a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-bell navs"></span> Notifications <span class="badge"><?php echo $r_row ?></span></a>
      <ul class="dropdown-menu">
        <?php
        while ($a_not = mysqli_fetch_array($r_not)) {
          $not_us = $a_not['id'];
          $time_ago = $a_not['time'];
          $q_not2 = "SELECT firstName,lastName FROM users WHERE id = '$not_us'";
          $r_not2 = mysqli_query($connection, $q_not2);
          $a_not2 = mysqli_fetch_array($r_not2);
          echo "<li><a href='#' onclick = 'load_post_notif".$a_not['postId']."()'>".$a_not2['firstName']." commented on your post on topic ".$a_not['topic']."</a></li>";
          ?>
          <script type="text/javascript">


          function load_post_notif<?php echo $a_not['postId'] ?>() {
          //$("#posts_holder").html("<div class='loader'>Loading...</div>");
          var more = 10;
            $.ajax({
              url : "load_posts.php",
              method : "POST",
              data : {
                post_notif: 1,
                postId: <?php echo $a_not['postId'] ?>,
                topic: '<?php echo $topic ?>',
                commentId: <?php echo $a_not['commentId'] ?>

              },
              success : function(data,status){
                $("#posts_holder").html(data);
              }
            })
          }

          </script>
          <?php
        }
        while ($a_like = mysqli_fetch_array($r_like)) {
          $like_us = $a_like['liker'];
          $q_lk = "SELECT firstName,lastName FROM users WHERE id = '$like_us'";
          $r_lk = mysqli_query($connection, $q_lk);
          $a_lk = mysqli_fetch_array($r_lk);
          echo "<li><a href='#' onclick = 'load_like_notif".$a_like['postId']."()'>".$a_lk['firstName']." liked your post on topic '".$a_like['topic']."'</a></li>";

          ?>
          <script type="text/javascript">
          function load_like_notif<?php echo $a_like['postId'] ?>() {
          //$("#posts_holder").html("<div class='loader'>Loading...</div>");
          var more = 10;
            $.ajax({
              url : "load_posts.php",
              method : "POST",
              data : {
                like_notif: 1,
                postId: <?php echo $a_like['postId'] ?>,
                topic: '<?php echo $topic ?>',
                likeId: <?php echo $a_like['likeId'] ?>

              },
              success : function(data,status){
                $("#posts_holder").html(data);
              }
            })
          }
          </script>
          <?php
        }
         ?>



      </ul>
  </li>
   <li class="dropdown">
     <?php
     $query = "SELECT * FROM status INNER JOIN news ON status.newId=news.newId WHERE status.id='$id' or status.id=17 and status.status = 1";
     $newsres = mysqli_query($connection,$query) or die(mysqli_error($connection));
     $newsrow = mysqli_num_rows($newsres);

      ?>
     <a href="#news" data-toggle="dropdown" class="dropdown-toggle"> <span class="glyphicon glyphicon-globe navs"></span> News <span class="badge"><?php echo $newsrow; ?></span></a>
     <ul class="dropdown-menu">
       <?php
       if ($newsrow == 0) {
         echo "<div class='text-center'>
         Nothing new<br>
         <a href='news.php'>View all news</a>
         </div>
         ";
       } else {
         while ($newsarray = mysqli_fetch_array($newsres)) {
             echo "<li><a href='news.php'>".$newsarray['title']."</a></li>";
           }
         }

        ?>
  </ul>
   </li>
   <li id="account"><a href="account.php?topic=All topics"><span class="glyphicon glyphicon-lock navs"></span> Account</a></li>
   <li id="available"><a href="availablejobs.php?page=1&search="><span class="glyphicon glyphicon-briefcase navs"> Jobs</span></a></li>

   <li class="dropdown" id="proposal">
     <?php
     $ctq = "SELECT COUNT(*) FROM proposal WHERE id = $id";
     $ctr = mysqli_query($connection,$ctq);
     $cta = mysqli_fetch_array($ctr);

     $ctiq = "SELECT COUNT(*) FROM proposal INNER JOIN jobs ON proposal.jobId = jobs.jobId WHERE jobs.id = $id";
     $ctir = mysqli_query($connection,$ctiq) or die(mysqli_error($connection));
     $ctia = mysqli_fetch_array($ctir);

     $ctt = $cta[0] + $ctia[0];
      ?>
     <a href="#proposal" class="dropdown-toggle" data-toggle="dropdown" data-target="#prop" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list"></span> Bids <span class="badge"><?php echo $ctt; ?></span><span class="caret"></span></a>
     <ul class="dropdown-menu">
       <li><a href="incomingproposals.php"><span class="glyphicon glyphicon-save"></span> Incoming<span class="badge"><?php echo $ctia[0] ?></span></a></li>
       <li><a href="outgoingproposals.php"><span class="glyphicon glyphicon-open"></span> Outgoing<span class="badge"><?php echo $cta[0] ?> </span></a></li>
     </ul>
   </li>

   <li class="dropdown">
     <a href="#help" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['fname']; ?><span class="caret"></span></a>
     <ul class="dropdown-menu">
       <li><a href="myprofile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
       <li><a href="../login/addphoto.php"><span class="glyphicon glyphicon-cog navs"></span> Settings</a></li>
       <li><a href="../login/logout.php"><span class="glyphicon glyphicon-log-out navs"></span> Logout</a></li>
       <?php
       if ($_SESSION['priv'] > 0) {
        echo '<li><a href="admin.php"><span class="glyphicon glyphicon-certificate navs">Admin</a></li>';
       }
        ?>

     </ul>
   </li>

  </ul>
  </div>

     </div>

   </nav>
