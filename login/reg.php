<?php
session_start();
include 'db.php';
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<?php include '../bootstrap.php'; ?>
<link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">
<link rel="stylesheet" href="css/register.css" media="screen" title="no title" charset="utf-8">

<style media="screen">

</style>
</head>
<body background="metro.png">

	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
				<a class="navbar-brand" href="#">Freelancers' Hub</a>
			</div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
  				<li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
  				<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a></li>
  			</ul>
      </div>

		</div>
	</nav>




		<div class="form container" id="form">
		<h3><span class="glyphicon glyphicon-pencil"></span> Registration</h3>
		<form name="form" action="registration.php" method="post">
      <div class="container">

            <div class="form-group">
      				<label for="">First Name*</label><span id="fname" class="ferror label label-danger"></span>
      				<input type="text" class="form-control" name="firstName" placeholder="First Name" required />
      			</div>


            <div class="form-group">
      				<label for="">Last Name*</label><span id="lname" class="ferror label label-danger"></span>
      				<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required />
      			</div>






            <div class="form-group">
      				<label for="">Username*</label><span id="username" class="ferror label label-danger"></span>
      				<input type="text" class="form-control" name="username" placeholder="Username" required />
      			</div>

            <div class="form-group">
        			<label for="">E-mail*</label><span id="email" class="ferror label label-danger"></span>
        			<input type="email" name="email" class="form-control" placeholder="Email" required />
        		</div>


            <div class="form-group">
        			<label for="">Nationality*</label><span id="country" class="ferror label label-danger"></span>
        			<?php
        			$q="SELECT name, phonecode FROM countries";
        			$qres=mysqli_query($connection,$q) or die(mysqli_error($connection));

        			 ?>
        			<select class="form-control" onchange="document.getElementById('phone_code').innerHTML = this.value;document.getElementById('phone_full').value = '+' + this.value + document.form.phone.value" name="country" onchange="look()">
                <option value="">-- Select your Country--</option>
        				<?php
        				while ($row=mysqli_fetch_array($qres)) {
        					echo "<option value='".$row['phonecode']."'>" .$row['name']. "</option>";
        					$found=$row['name'];
        					$qq="SELECT phonecode FROM countries WHERE name='$found'";
        					$qqres=mysqli_query($connection,$qq);
        					$row2=mysqli_fetch_array($qqres);
        					$_SESSION['code']=$row2['phonecode'];

        				}

        				 ?>
        			</select>

        		</div>
            <div class="form-group">
              <label for="">Phone*</label><span id="phone" class="ferror label label-danger"></span>

              <div class="input-group">

                <span class="input-group-addon">+<span id="phone_code"></span></span>

          			<input type="number" class="form-control" onchange="document.getElementById('phone_full').value = '+' + document.form.country.value + this.value" name="phone" placeholder="Phone" value="" required />
                <input type="text" name="phone_full" id="phone_full" value="" hidden="hidden">
          		</div>
            </div>
                <div class="form-group">
        			<label for="">Year Of Birth*</label><span id="dob" class="ferror label label-danger"></span>
              <select class="form-control" name="dob">
                <option value="">--Select your year of birth--</option>
                <?php
                for ($year = 2017; $year > 1920; $year--) {
                  echo "<option value='".$year."'>".$year."</option>";
                }
                 ?>
              </select>
        		</div>
            <div class="form-group">
        			<label for="">Password*</label><span id="password" class="ferror label label-danger"></span>
        			<input type="password" onkeyup="passstr()" class="form-control" name="password" placeholder="Password" required />
        		</div>
            <div class="form-group">
              <label for="">Confirm password*</label><span id="password2" class="ferror label label-danger"></span>
              <input type="password" class="form-control" name="password2" placeholder="Confirm password" required />

            </div>



      </div>


		<div class="form-group">
      <div class="checkbox">
                <label>
                  <input name="remember" type="checkbox" value="Terms">
                  I agree to the <a href="#">terms and conditions</a>.
                </label>
              </div><br>
			<input type="button" onclick="checkForm()" class="btn btn-lg btn-primary btn-block" value="Register" />
      <p>
  			Already have an account?
  			<a href="login.php">Login Here</a>
  		</p>
		</div>

		</form>




    <script>
    function passstr() {
      var pwd = document.getElementById("password");
      pwd.innerHTML = "";

      var pp = document.form.password.value;
      var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
      var mediumRegex = new RegExp("^(?=.{6,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
      var enoughRegex = new RegExp("(?=.{5,}).*", "g");

     if (pp == 0) {
       pwd.innerHTML = '';

      } else if (false == enoughRegex.test(pp)) {
      pwd.innerHTML = ' Type in more characters';
      } else if (strongRegex.test(pp)) {
      pwd.innerHTML = '<span style="color:green"> Strong!</span>';
      } else if (mediumRegex.test(pp)) {
      pwd.innerHTML = '<span style="color:orange"> Medium!</span>';
      } else {
      pwd.innerHTML = '<span style="color:red"> Weak!</span>';
      }


    }

          function checkForm()
          {
            document.getElementById('fname').innerHTML = "";
            document.getElementById('lname').innerHTML = "";
            document.getElementById('username').innerHTML = "";
            document.getElementById('email').innerHTML = "";
            document.getElementById('country').innerHTML = "";

            document.getElementById('phone').innerHTML = "";
            document.getElementById('password').innerHTML = "";
            document.getElementById('password2').innerHTML = "";
            document.getElementById('dob').innerHTML = "";

           if (document.form.firstName.value == "") {
              document.getElementById('fname').innerHTML = " First name cannot be blank";
              document.form.firstName.focus();
            } else if (document.form.lastName.value == "") {

              document.getElementById('lname').innerHTML = " Last name cannot be blank";
              document.form.lastName.focus();
            } else if (document.form.username.value == "") {
              document.getElementById('username').innerHTML = " Fill out this field";
              document.form.username.focus();
            } else if (document.form.email.value == "") {
              document.getElementById('email').innerHTML = " Your email is required";
              document.form.email.focus();
            } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.form.email.value)) {

                document.getElementById('email').innerHTML = " Enter a valid E-mail address";
                document.form.email.focus();

            } else if (document.form.country.value == "") {
              document.getElementById('country').innerHTML = " Select your country";
              document.form.country.focus();
            } else if (document.form.phone.value == "") {
              document.getElementById('phone').innerHTML = " Phone number is required";
              document.form.phone.focus();
            } else if (document.form.dob.value == "") {
              document.getElementById('dob').innerHTML = " Fill out this field";
              document.form.dob.focus();
            } else if (document.form.password.value == "") {
              document.getElementById('password').innerHTML = " Password cannot be empty";
              document.form.password.focus();
            } else {
              if(document.form.password.value.length < 6) {
                document.getElementById('password').innerHTML = " Password must contain at least six characters!";
                document.form.password.focus();
              } else if (document.form.password.value == document.form.firstName.value || document.form.password.value == document.form.lastName.value ) {
                document.getElementById('password').innerHTML = " Password must be different from your name!";
                document.form.password.focus();
              } else if (document.form.password2.value == "") {
                document.getElementById('password2').innerHTML = " Please confirm your password!";
                document.form.password2.focus();
              } else if (document.form.password.value != document.form.password2.value) {
                document.getElementById('password2').innerHTML = " Passwords do not match!";
                document.form.password2.focus();
              } else {

                document.form.submit();



              }
            }

            }
          //End of password validation
        /*  $(document).ready(function () {
            $(document.form).on('submit', function (e) {
              e.preventDefault();
              $.ajax({
                url:"registration.php",
                type:"POST",
                data: new FormData(this),
                success: function (data,status) {
                  alert(data+status);
                }
              });
            });
          });*/

    </script>







		</div>



</body>
</html>
