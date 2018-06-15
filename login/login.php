<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<?php include '../bootstrap.php'; ?>

<link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">
<link rel="stylesheet" href="css/login.css" media="screen" title="no title" charset="utf-8">
<link rel="stylesheet" href="../user/style.css" media="screen" title="no title" charset="utf-8">


</head>
<body background="../imgresource/eaglefly.jpg">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
				<a class="navbar-brand" href="#">EAGLE LENS</a>
			</div>
			<div class="collapse navbar-collapse text-center" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
					<li><a href="reg.php"><span class="glyphicon glyphicon-pencil"></span> REGISTER</a></li>
				</ul>
			</div>

		</div>
	</nav>


	<div class="lgnfrmcvr">

		<div class="form">
		<h3><span class="glyphicon glyphicon-log-in"></span> Log In</h3>
		<div class="alert alert-danger" id="error" hidden="hidden" style="color:red">

		</div>
		<form>
			<div class="form-group">
				<label for="username">USERNAME</label>
				<input type="text" name="username" class="form-control" placeholder="Username" id="username" required />
			</div>
			<br>
		<div class="form-group">
			<label for="password">PASSWORD</label>
			<input type="password" class="form-control" name="password" placeholder="Password" id="password" required />
		</div>
		<br>
	<div class="form-group log_hold">
		<input name="submit" type="button" id="login" class="btn btn-md btn-default" value="Log in" />
	</div>

		</form>
		<p>Not registered yet? <a href='reg.php'>Register Here</a></p>
		</div>
	</div>

<script type="text/javascript">
$(document).ready(function() {
  $('#login').click(function() {
		$('.log_hold').html('<div class="loader"></div>');

      $.ajax({
          type: "POST",
          url: 'processed.php',
          data: {
              username: $("#username").val(),
              password: $("#password").val()
          },
          success: function(data)
          {
              if (data === 'Correct') {

                window.location.replace('../user/account.php?topic=All topics');
              }
              else {
								document.getElementById("error").style.display="block";
                  document.getElementById("error").innerHTML="WRONG CREDENTIALS! USERNAME OR PASSWORD IS INCORRECT";
									$('.log_hold').html('<input name="submit" type="button" id="login" class="btn btn-md btn-default" value="Log in" />');

              }
          }

      });

  });

});
</script>

  </body>
</html>
