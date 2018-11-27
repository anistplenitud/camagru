<?php
	include 'config/connect.php';
	include 'classes/User.class.php';

	if (!isset($_POST['email'])) {
		header('Location: ./');
	}

	$email = $_POST['email'];

	$que = $conn->query('SELECT * FROM `db_camagru`.`users`');

	$users = $que->fetchAll(PDO::FETCH_CLASS, 'User');
	
	$w = 0;
		foreach ($users as $user) {
			if ($user->e_mail == $email)
			{
				$ver_token = $user->verification_token;
				echo "An E-mail has been will be sent to you in a few seconds";
				$w = 1;

			}	
		}
	if ($w != 1)
	{
		echo "This E-mail is not registered on Camagru. MAybe check spelling ?";
		exit(0);
	}

	$msg = "<!DOCTYPE html>
	<html>
	<head>
		<title>Password Reset</title>
	</head>
	<body>
		<H1> Hello! </H1>
		<p>Once more Step ! Please the link below to reset your Password.</p>
		<a href='http://localhost:8080/Camagru/profile/index.php?token=".$ver_token."&email=".$email."'>Reset My Password</a>
		</body>
		</html>";

		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		// send email
		mail($email,"Camagru Password Reset",$msg, implode("\r\n", $headers));

?>