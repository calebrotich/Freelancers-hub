<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<?php include '../bootstrap.php'; ?>

<link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">
<link rel="stylesheet" href="css/login.css" media="screen" title="no title" charset="utf-8">
<link rel="stylesheet" href="../user/style.css" media="screen" title="no title" charset="utf-8">
<link rel="shortcut icon" href="img/icons/favicon.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/icons/114x114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/icons/72x72.png">
<link rel="apple-touch-icon-precomposed" href="img/icons/default.png">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" rel="stylesheet">

<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Libraries CSS Files -->
<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">
<link href="lib/owlcarousel/owl.theme.min.css" rel="stylesheet">
<link href="lib/owlcarousel/owl.transitions.min.css" rel="stylesheet">

<!-- Main Stylesheet File -->
<link href="css/style.css" rel="stylesheet">

<!--Your custom colour override - predefined colours are: colour-blue.css, colour-green.css, colour-lavander.css, orange is default-->
<link href="#" id="colour-scheme" rel="stylesheet">
</head>
<body class="fullscreen-centered page-login">
<div id="background-wrapper" class="benches" data-stellar-background-ratio="0.8">

	<!-- ======== @Region: #content ======== -->
	<div id="content">
		<div class="header">
			<div class="header-inner">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							Login
						</h3>
					</div>
					<div class="panel-body">
						<form accept-charset="UTF-8" role="form">
							<fieldset>
								<div class="form-group">
									<div class="input-group input-group-lg">
										<span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
										<input type="text" class="form-control" placeholder="Email">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group input-group-lg">
										<span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
										<input type="password" class="form-control" placeholder="Password">
									</div>
								</div>
								<div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me">
										Remember Me
									</label>
								</div>
								<input class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
							</fieldset>
						</form>
						<p class="m-b-0 m-t">Not signed up? <a href="register.php">Sign up here</a>.</p>
					</div>
				</div>
			</div>
		</div>
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
