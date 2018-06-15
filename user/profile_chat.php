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
<link rel="stylesheet" href="user.css">
<style media="screen">
.chatbox {
  background: #fff;

width: 100%;
min-width: 390px;
padding: 25px;
margin: 20px auto;

font-family: tahoma,sans-serif;

}
  .chatlogs {
padding: 10px;
margin-bottom: 0;

  }
  .chat {
    display: flex;
    flex-flow: row wrap;
    align-items: flex-start;
    margin: 0 auto;

  }
  .chat .userphoto {
    width: 50px;
    height: 50px;
    background: #ccc;
    border-radius: 50%;
    overflow: hidden;
  }
  .chat .userphoto img{
    width: 100%;
    height: 100%;
  }
  .chat .chatmessage {
    width: 80%;
    padding: 15px;
    margin: 5px 10px 0;
    border-radius: 10px;

    font-size: 18px;
  }
  .c<?php echo $id ?> .chatmessage{
    background: #d6d6c2;
    order: -1;

  }
  .c<?php echo $sender ?> .chatmessage{

background: #f88d6d;
  }

  .chat .chatmessage {
    font-size: 16px;
  }
  .chat {
    display: flex;
    flex-flow: row wrap;
    align-items: flex-start;
    margin-bottom: 10px;
    width: 90%;
    padding: 15px;
    border-radius: 10px;
  }


.chatform {
  margin-top: 20px;
  display: flex;
  align-items: flex-start;
}
.chatform textarea {
  width: 90%;
  height: 40px;
  margin-bottom: 30px;
  resize: none;
  padding: 5px;
  font-size: 17px;
  color: #333;

}
.chatform #chatbtn {
  padding: 5px 15px;
  border: none;
  margin: 2px 10px;
  border-radius: 3px;
}

.c<?php echo $id ?> .pull-right {

}
.c<?php echo $sender ?> .pull-right {

}
</style>


<?php
$chatq = "SELECT * FROM propchat WHERE propId = '$pid'";
$chatr = mysqli_query($connection,$chatq);
$chatrw = mysqli_num_rows($chatr);
?>
<div class="chatbox">
<div class="chatlogs">
<?php
if ($chatrw < 1) {
  echo "<div class='jumbotron'><h5>Type below to start interview.</h5></div>";
}
while ($chata = mysqli_fetch_array($chatr)) {
  $w = $chata['sender'];
  $session=$_SESSION['username'];
  $sessionid=$_SESSION['id'];
  $query="SELECT displayPic FROM displayPic WHERE id='$w'";
  $result=mysqli_query($connection,$query);
  $row=mysqli_fetch_array($result);
  $pic= $row['displayPic'];
if ($chatrw == 0) {
echo "<div class='jumbotron'>Type below to begin Interviewing </div>";
} else {
$sender = $chata['sender'];
$time_ago = $chata['time'];
?>

    <div class="chat <?php echo 'c'.$sender ?>" id="">
      <div class="userphoto"><img src="displaypic/<?php echo $pic ?>" alt=""></div>
      <p class="chatmessage"><?php echo $chata['message']; ?></p>
      <span class="pull-right" style="font-size: 12px; color:#999"><?php include 'timer.php'; ?></span>

    </div>

<?php


  }

}

?>
<form class="chatform" action="" method="post" style="position:fixed;bottom:0">
<textarea class="" id="chatmes" name="interview" rows="1" cols="60" required></textarea>
<button type="button" id="chatbtn" name="button" class="btn btn-danger"><span class="glyphicon glyphicon-send"></span></button>

</form>
</div>
</div>






<script type="text/javascript">

$(document).ready(function(){
$("#chatbtn").click(function(){
var reply = $("#chatmes").val();
var sender = <?php echo $_SESSION['id'] ?>;
var receiver = <?php echo $id; ?>;
var propid = <?php echo $pid; ?>;
if(reply=='')
{
alert("Please fill out the form");
}

else{
$.post("propchat.php", //Required URL of the page on server
{ // Data Sending With Request To Server
reply:reply,
sender:sender,
receiver:receiver,
propid:propid

},
function(response,status){ // Required Callback Function
load_chat();

//$("#form")[0].reset();
});
}
});
});

</script>
