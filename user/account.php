<?php
include("../login/auth.php"); //include auth.php file on all secure pages
require '../login/db.php';
$session=$_SESSION['username'];
$id = $_SESSION['id'];

$topic = $_GET['topic'];
$more = 10;


$postquery="SELECT * FROM post INNER JOIN users ON post.id=users.id WHERE topic = '$topic' ORDER BY post.postId DESC LIMIT 0,$more";
$postresult=mysqli_query($connection,$postquery) or die(mysqli_error($connection));
$postrow=mysqli_fetch_array($postresult);

$postquery2="SELECT * FROM post INNER JOIN users ON post.id=users.id WHERE topic = '$topic'";
$postresult2=mysqli_query($connection,$postquery2) or die(mysqli_error($connection));
$num = mysqli_num_rows($postresult2);

$currentUser=$postrow["username"];


include 'dpic.php';


 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eagle lens</title>
    <?php include '../bootstrap.php'; ?>

    <link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">

    <link rel="stylesheet" href="user.css" media="screen" title="no title" charset="utf-8">

    <style media="screen">
    span.beforepriv {
      visibility: hidden;
    }
      span.priv<?php echo $id ?> {
        visibility: visible;

      }

    </style>
    <script type="text/javascript">
    function browser_resize() {
      nav_beh();
      $(function () {
        if (window.innerWidth > 767) {
          var browser_height = (window.innerHeight - 60);
          $('#centerdiv, #sidenav, #info_panel').css('height', browser_height);
          $('#centerdiv, #sidenav, #info_panel').addClass('tab-pane active in');
          $('div.wrapper').addClass('tab-content');
          $('.nav-tabs').css('display','none');

        } else {
          $('#centerdiv, #sidenav, #info_panel').addClass('tab-pane fade');
          $('#centerdiv').addClass('tab-pane active fade in');
          $('#sidenav, #info_panel').removeClass('active');

          $('div.wrapper').addClass('tab-content');
          $('.nav-tabs').css('display','block');
          $('#centerdiv, #sidenav, #info_panel').css('height', '100%');

        }

      });
    }

    </script>
  </head>
  <body onresize="browser_resize()" onload="browser_resize()">
    <script type="text/javascript">
    $(function() {
      $('#notif_drop').show();

    });

    </script>

<?php include 'nav.php'; ?>

<div class="container-fluid content">

  <ul class="nav nav-tabs">
    <li><a data-toggle="tab" href="#sidenav">Profile</a></li>
    <li class="active"><a data-toggle="tab" href="#centerdiv">Discussions</a></li>
    <li><a data-toggle="tab" href="#info_panel">Extras</a></li>
  </ul>

  <div class="row wrapper">
    <div class="col-sm-4 sidenav text-center" id="sidenav">
      <div class="well">
        <p class="title">
          PROFILE
        </p>
<?php
echo $_SESSION['fname']." ".$_SESSION['lname'];
 ?>
 <div class="" style="position:relative">
   <img title="profile" src='displayPic/<?php echo $pic ?>'  alt='profile photo' height='100' width='130' data-toggle="modal" data-target="#prof" style="cursor: pointer" />
   <form class="" action="changedp.php" id="fileup_form" method="post" enctype="multipart/form-data">

   <input type="file" id="fileup" onchange="file_up()" accept="image/*" name="file" class="form-control inputfile" value="" required="">
   <label id="cam" class="glyphicon glyphicon-camera" for="fileup"></label>
 </form>
 </div>
 <script type="text/javascript">
 function file_up() {
   document.getElementById('fileup_form').submit();
 }
 </script>

<div class="well">
  <?php
  $qs = "SELECT * FROM skills WHERE id = '$id'";
  $res = mysqli_query($connection,$qs) or die(mysqli_error());
  $row = mysqli_num_rows($res);
  $array = mysqli_fetch_array($res);
   ?>
  <p class="title">
    Description
  </p>
  <?php
  if ($row == 0) {
    echo "No description yet <br>
    <a href='../login/addphoto.php'>Edit</a>
    ";
  } else {
    echo $array['description'];
    echo "<br><a href='../login/addphoto.php'>Edit</a>";

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
    <a href='../login/addphoto.php'>Edit</a>
    ";

  } else {
    $ss = $array['skills'];
    $ssin = explode(",",$ss);
    for ($i=0; $i < count($ssin) ; $i++) {
      echo $ssin[$i]."<br>";
    }

    echo "<br><a href='../login/addphoto.php'>Edit</a>";
  }
    ?>
</div>

        <div class="well">
          <p class="title">
            INTERESTS
<div class="">
  <?php
  $interest = $array['interests'];
  $int_list = explode(",",$interest);
  for ($i=0; $i < count($int_list) ; $i++) {
    echo $int_list[$i]."<br>";
  }
    ?>

</div>
          </p>
        </div>
      </div>
    </div>



    <div class="col-sm-5 active in" id="centerdiv">


    <div class="myPost">
<center>
  <span class="dropdown">
    <h4 style="color: #f4511e;cursor:pointer" title="Change topic" data-toggle="dropdown"><?php echo $topic ?><span class="caret"></span></h4>

          <div class="dropdown-menu">
            <span class="dropdown-header">SWITCH TOPIC</span>
            <?php
            $change_t = "SELECT name FROM topics";
            $change_r = mysqli_query($connection,$change_t);
            echo "<li><a href='account.php?topic=All topics'>All topics</a></li>";
            while ($change_a = mysqli_fetch_array($change_r)) {
              echo "<li><a href='account.php?topic=".$change_a['name']."'>".$change_a['name']."</a></li>";
            }
             ?>

          </div>

</span>
</center>
<?php if ($topic != 'All topics'): ?>
  <form class="" name="thisform" action="post.php" method="post">
    <div class="form-group">

      <textarea name="postText" onfocus="show_button()" rows="1" id="postText" class="form-control" cols="60" placeholder="Post something on <?php echo $topic ?>..." required=""></textarea><br>
      <input type="text" name="topic" value="<?php echo $topic ?>" hidden="hidden">
      <span class="pull-right" id="onhold">
        <input type="button" id="post_submit" onclick="submit_post()" class="btn btn-sm btn-default" name="name" value="POST">
      </span>
    </div>
    <script type="text/javascript">
document.getElementById('post_submit').style.display = "none";
document.getElementById('postText').style.height = "40px";

function show_button() {
document.getElementById('post_submit').style.display = "block";
document.getElementById('postText').style.height = "100px";

}
function submit_post() {
  $('#onhold').html('<div class="loader sugg_post"></div>');
 $.post("post.php",
 {
   postText: document.thisform.postText.value,
   topic: document.thisform.topic.value
 }, function() {
   document.thisform.reset();
   load_posts();
   $('#onhold').html('<input type="button" id="post_submit" onclick="submit_post()" class="btn btn-sm btn-default" name="name" value="POST">');

 }
);
}
    </script>
  </form>

<?php endif; ?>



    </div>
    <?php



//posts
?>
<script type="text/javascript">
load_posts();

function load_posts() {
$(".l_post").show();

var more = 10;
  $.ajax({
    url : "load_posts.php",
    method : "POST",
    data : {
      initial_post: 1,
      topic: '<?php echo $topic ?>',
      more: <?php echo $more ?>
    },
    success : function(data,status){
      $("#posts_holder").html(data);
      $(".l_post").hide();


    }
  })

}

</script>
<div class="loader l_post">

</div>
<div class="" id="posts_holder">

</div>


<?php
if ($num > 10) {
  ?>
  <center>
    <input type="number" id="load_counter" name="topic" value="20" hidden="">
    <span id="end_of_post">
      <div class="loader l_more_posts" style="display:none">
      </div>
    <input type="button" name="" id="more_posts" class="btn btn-sm" value="Load more...">
    <br><br>
    </span>
      </center>
  <?php
}
 ?>

    <script type="text/javascript">

    $("#more_posts").click(function(){
$('#end_of_post .l_more_posts').show();
$('#end_of_post #more_posts').hide();

      var value = document.getElementById('load_counter').value;
      var more = parseInt(value);
      var number = <?php echo $num ?>;
      if (more > number) {
        document.getElementById('end_of_post').innerHTML = ".";
      }


      $.ajax({
        url : "load_posts.php",
        method : "POST",
        data : {
          initial_post: 1,
          topic: '<?php echo $topic ?>',
          more: more
        },
        success : function(data,status){

document.getElementById('load_counter').value = more + 10;

          $("#posts_holder").html(data);
        }
      })

    })



    </script>




    </div>
    <div class="col-sm-3" id="info_panel">
<div class="jumbotron text-center">
  <p>
    <span class="reaction">
  <a href="availablejobs.php?page=1&search=">Available jobs</a>
    </span>
  </p>


<a type="button" href="postjob.php" class="btn btn-info btn-md">POST A JOB</a>



</div>
<div class="jumbotron">
  <div class="text-center">
    <h3>TOPICS</h3>
    <input type="button" class="btn btn-sm" name="name" data-toggle="collapse" data-target="#suggest" value="Suggest a topic">
    <div class="alert alert-success fade-in" id="consider" hidden="hidden">
      <span onclick="revert()" class="pull-right glyphicon glyphicon-remove" style="cursor:pointer;" aria-label="close"></span>
      <strong class="glyphicon glyphicon-ok">  Done</strong><br>
      <span>
        Your Suggestion will be considered!
      </span>
    </div>
    <div id="suggest" class="collapse">
      <form action="" name="sugg_form" method="post">

        <div class="input-group">
          <input type="text" name="sugg_name" id="sugg_name" value="">
<div class="input-group-btn">
  <button type="button" class="btn btn-default"  onclick="sugg_insert()" name="button" id="sugg_bt">
    <span class="glyphicon glyphicon-send"></span>

  </button>
</div>
        </div>
      </form>
      <script type="text/javascript">
      function sugg_insert() {
        $('#sugg_bt').html('<div class="loader sugg_post"></div>');
        $.post("account.php",{sugg_name: document.sugg_form.sugg_name.value, sugg:1},function () {
          document.sugg_form.reset();
          $('#sugg_bt').html('<span class="glyphicon glyphicon-send"></span>');

          considered();
        });
      }

      </script>
    <?php
    if (isset($_POST['sugg'])) {
    $sugg_name = $_POST['sugg_name'];
    $sugg_q = "INSERT INTO topic_suggestions (sugg_name,sugg_owner) VALUES('$sugg_name','$id')";
    $sugg_r = mysqli_query($connection,$sugg_q);
    }
    ?>
    </div>
  </div>



  <br>
  <?php
  $change_t = "SELECT name FROM topics";
  $change_r = mysqli_query($connection,$change_t);
  while ($change_a = mysqli_fetch_array($change_r)) {
    echo '
    <span class="reaction" style="margin-left: 32%">
      <a href="account.php?topic='.$change_a["name"].'">'.$change_a["name"].'</a>
    </span>
    <br>
    ';
  }
   ?>

</div>


    </div>
  </div>
</div>
<script type="text/javascript">
function considered() {
  document.getElementById("consider").style.display="block";
}
function revert() {
  document.getElementById("consider").style.display="none";
}
</script>

<script type="text/javascript">
// Warning Duplicate IDs
/*$('[id]').each(function(){
var ids = $('[id="'+this.id+'"]');
if(ids.length>1 && ids[0]==this){
  console.warn('Multiple IDs #'+this.id);

} else {
  console.warn('No duplicate ids');
}
});*/
</script>
<script type="text/javascript">
  document.getElementById('account').className="active";
</script>



  </body>
</html>
