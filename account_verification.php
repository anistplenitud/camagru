<!DOCTYPE html>
<html>
<head>
	<title>Camagru Account Verification</title>
</head>
<body>
	<form action="verify.php" method="POST">
		<input type="text" name="verification_pin" value="<?php 
		if (isset($_GET['token'])) {
			echo $_GET['token'];
		}
		?>" required>
		<input type="submit" name="submit" value="Verify">
	</form>
	<div>
		<p>
			You have been sent a verification code in the e-mail you entered during registration. <br>
			Use the code in your e-mail to verify your account <br><br>
			If the e-mail is wrong, or you haven't registered at all , <a href="./">sign-up here!</a> 
		</p>
	</div>
	<img src="https://privacy.google.com/images/animations/your-security/last-frame-1.svg">

</body>
</html>