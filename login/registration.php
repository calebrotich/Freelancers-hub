<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">
<?php include '../bootstrap.php'; ?>



</head>
<body>

<?php
	require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_POST['username'])){
			$firstName=$_POST['firstName'];
			$lastName=$_POST['lastName'];
			$phone=$_POST['phone_full'];
			$dob=$_POST['dob'];
      $username = $_POST['username'];
		  $email = $_POST['email'];
      $password = $_POST['password'];
			$nationality = $_POST['country'];
		  $username = stripslashes($username);
		  $username = mysqli_real_escape_string($connection,$username);
		  $email = stripslashes($email);
		  $email = mysqli_real_escape_string($connection,$email);
		  $password = stripslashes($password);
		  $password = mysqli_real_escape_string($connection,$password);
		  $trn_date = date("Y-m-d H:i:s");

        $query = "INSERT INTO `users` (username, password, email, trn_date,firstName,lastName,phone,dob,nationality)
				 VALUES ('$username', '".md5($password)."', '$email', '$trn_date','$firstName','$lastName','$phone','$dob','$nationality')";
        $result = mysqli_query($connection,$query) or die(mysqli_error($connection));
				$q = "SELECT * FROM users WHERE username='$username'";
				$qresult = mysqli_query($connection,$q);
				$qrow = mysqli_fetch_array($qresult);
        if($result){
					$_SESSION['username'] = $username;
					$_SESSION['id'] = $qrow['id'];
					$_SESSION['fname'] = $qrow['firstName'];
					$_SESSION['lname'] = $qrow['lastName'];
					$_SESSION['nationality'] = $qrow['nationality'];

					$q3=$qrow['id'];
					$qpc="INSERT INTO displaypic(id,displayPic) VALUES('$q3','icon.ico')";
					mysqli_query($connection,$qpc);
					echo "<script>document.location.href = 'addphoto.php'</script>";
          //header("location:addphoto.php");
        }
    }else{
?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Freelancers' Hub</a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
			<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a></li>
		</ul>
	</div>
</nav>
<div class="jumbotron">
	<div class="form">
	<h3>Registration</h3>
	<form name="registration" action="" method="post">
	<input type="text" name="username" placeholder="Username" required />
	<input type="email" name="email" placeholder="Email" required />
	<input type="password" name="password" placeholder="Password" required />
	<input type="submit" name="submit" value="Register" />
	</form>
	</div>
</div>

<?php } ?>
</body>
</html>
