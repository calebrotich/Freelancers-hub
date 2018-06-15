<?php
$session=$_SESSION['username'];
$sessionid=$_SESSION['id'];
$query="SELECT displayPic FROM displayPic WHERE id='$sessionid'";
$result=mysqli_query($connection,$query);
$row=mysqli_fetch_array($result);
$pic= $row['displayPic'];
 ?>
