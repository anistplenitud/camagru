<?php
session_start();

 if (isset($_SESSION['id'])) {
 	header('Location: ./home');	
 }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Camagru</title>
	<style type="text/css">
		body {
			background-color: lightblue;
		}
		#gallery {
			position: absolute;
			height: 100%;
			width: 60%;
			top: 0%;
			left: 40%;
			overflow: hidden;
		}

		body form input {
			width: 20vw;
			font-size: 2vw;	
		}
		body form label {
			width: 20vw;
			font-size: 2vw;
		}

		body h1 {
			font-size: 2vw;	
		}
		body {
			font-size: 2vw;	
		}
	</style>
</head>
<body>
	<form name="signup_form" action="signup.php" method="post" onsubmit="return validateForm()">
		<div id = "signup_form">
			<h1 id ="signup_header"> Sign Up! </h1>
				<br />
			<div id ="signup_inputs">
				<div id = "group1">	
					<label >Name : </label> <br />
					<input class="signup_inputs"type="text" name="name" required autocomplete>
					<br />
				</div>
			<div id = "group2">
				<label>Surname : </label> <br />
				<input class="signup_inputs" type="text" name="surname" required autocomplete>
					<br />
			</div>
			<div id ="group3">
				<label>E- Mail :</label> <br />
				<input class="signup_inputs" type="email" name="email" required autocomplete>
					
			</div>
			<div id = "group4">
				<label>Enter Password :</label><br />
				<input class="signup_inputs" type="password" name="password" autocomplete>
					<br />
			</div>
			<div id = "group5">
				<label>Confirm Password :</label><br />
				<input class="signup_inputs" type="password" name="c_password" autocomplete>
					<br />
			</div>
			<input id="signup_btn" type="submit" name="submit" value="Sign Up" autocomplete>
		
		</div>
	</form>

	<form action="login.php" method="post">
		<div id = "login_form">
			<h1 id = "login_header"> Log In! </h1>
			<br>
			<div id="login_inputs">
				<div>
					<label>e-mail : </label> <br />
					<input type="email" name="e_mail" required autocomplete> <br>
					<label>password : </label> <br />
					<input type="password" name="password" required autocomplete> <br>
					<input type="submit" name="submit" value="Log In">
				</div>
			</div>
		</div>
	</form>
	<div>
		<a href="resetpassword.php">Forgot Password</a>
	</div>
	<div id="gallery">
		<object type="text/html" data="gallery/index.php" height="100%" width="100%" style="overflow:hidden;"></object>
	</div>
</body>
</html>

<script type="text/javascript" src="js/signup.js"></script>