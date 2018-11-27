<?php
	session_start();
	date_default_timezone_set('Africa/Johannesburg');

	include 'config/connect.php';
	include_once 'classes/User.class.php';

	if (!isset($_POST['name']) || !isset($_POST['surname']) || !isset($_POST['email']) || !isset($_POST['password'])) {
		header('Location: ./');

	}

	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	$passwd = hash('whirlpool',$_POST['password']);

	if (!$name || !$passwd || !$surname || !$email )
	{
		echo "ERROR\n";
		exit();
	}
	else
	{
		$que = $conn->query('SELECT * FROM `db_camagru`.`users`');

		$users = $que->fetchAll(PDO::FETCH_CLASS, 'User');

		foreach ($users as $user) {
			if ($user->e_mail == $email)
			{
				echo "This e-mail is already registered on the site.";
				exit(0);
			}	
		}
		$ver_token = md5(uniqid(rand(), true));
		echo $ver_token."\n";
		$try = date('Y-m-d H:i:s', time());

		$sql = $conn->prepare("INSERT INTO `db_camagru`.`users` (`name`, `surname`, `e_mail`, `password`, `account_verified`, `verification_token`, `last_login`) VALUES (:name, :surname, :email, :passwd, :acc_ini, :ver_token, :try)");
		$sql->bindParam(':name', $name);
		$sql->bindParam(':surname', $surname);
		$sql->bindParam(':email', $email);
		$sql->bindParam(':passwd', $passwd);
		$sql->bindParam(':acc_ini', $acc_ini);
		$sql->bindParam(':ver_token', $ver_token);
		$sql->bindParam(':try', $try);
		$acc_ini = 0;

		$sql->execute();
    	// the message
		$msg = "<!DOCTYPE html>
		<html>
		<head>
			<title>Welcome to Camagru</title>
		</head>
		<body>
		<H1> Hello! </H1>
		<p>Once more Step ! Please Verify your account either by clicking on the link below.</p>
		<a href='http://localhost:8080/Camagru/account_verification.php?token=".$ver_token."'>link</a>
		<p> alternatively, you can copy and paste your verification pin when prompted by Camagru after log in </p>
		<label>verifcation token : </label>
		<H3>".$ver_token."</H3> 
		</body>
		</html>";

		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		// send email
		mail($email,"Camagru Verification E-mail",$msg, implode("\r\n", $headers));

		$que = $conn->query('SELECT * FROM `db_camagru`.`users`');

		$users = $que->fetchAll(PDO::FETCH_CLASS, 'User');
		foreach ($users as $user) {
			if ($user->e_mail == $email)
			{
				$_SESSION['id'] = $user->id;
				echo "|||".$user->id."|||";
				break;	
			}
		}
		echo "{}{}".$_SESSION['id']."{}{}";
    	echo "Account Successfully Created.";
		 // either get id from database or make a plan ...

		$_SESSION['name'] = $name;
		$_SESSION['surname'] = $surname;
		$_SESSION['passwd'] = $passwd;
		$_SESSION['email'] =  $email;
		$_SESSION['account_verified'] =  0;
		$_SESSION['verification_token'] = $ver_token;
		$_SESSION['email_notif'] = 1;
    	header('Location: account_verification.php');

	}
?>