<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<style type="text/css">
		body {
			background-image: url('https://www.entrustdatacard.com/products/sms-passcode/-/media/images/products/sms-passcode/product_icon_passwordreset.png');
			background-repeat: no-repeat;
			background-position: bottom-right;
		}
	</style>
</head>
<body>
	Enter Registered e-mail Address to recieve a link to reset your password :
	<form action="verifyreset.php" method="POST">
		<input id="e_mail" type="email" name="email">
		<input type="button" name="submit" onclick="sendEmail()" value="Reset My Password">
	</form>
	<div id="demo">
		
	</div>
</body>
</html>
<script type="text/javascript" src="js/resetpassword.js"></script>