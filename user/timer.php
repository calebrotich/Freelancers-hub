<?php
include '../login/db.php';

$q = "SELECT NOW()";
$qres = mysqli_query($connection,$q);
$row = mysqli_fetch_array($qres);

$timer = $row[0];
    $time_ago =  strtotime($time_ago) ? strtotime($time_ago) : $time_ago;
    $timer =  strtotime($timer) ? strtotime($timer) : $timer;

    $time  = $timer - $time_ago;


switch($time) {
// seconds
case $time < 60:
echo 'Just now';
// minutes
break;
case $time >= 60 && $time < 3600:
echo (round($time/60) == 1) ? '1 minute ago' : round($time/60).' minutes ago';
// hours
break;
case $time >= 3600 && $time < 86400:
echo (round($time/3600) == 1) ? '1 hour ago' : round($time/3600).' hours ago';
// days
break;
case $time >= 86400 && $time < 604800:
echo (round($time/86400) == 1) ? '1 day ago' : round($time/86400).' days ago';
// weeks
break;
case $time >= 604800 && $time < 2600640:
echo (round($time/604800) == 1) ? '1 week ago' : round($time/604800).' weeks ago';
// months
break;
case $time >= 2600640 && $time < 31207680:
echo (round($time/2600640) == 1) ? '1 month ago' : round($time/2600640).' months ago';
// years
break;
case $time >= 31207680:
echo (round($time/31207680) == 1) ? '1 year ago' : round($time/31207680).' years ago' ;
break;
default:
echo "Nothing";

}

?>
