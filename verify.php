<?php
	session_start();
	if ($_POST['verification_pin']) {

		$token = $_POST['verification_pin'];
	}
	else
	{
		header('Location: account_verification.php');	 
	}
	include_once 'classes/User.class.php';
	include_once 'config/connect.php';

    $que = $conn->query('SELECT * FROM `db_camagru`.`users`');

	$users = $que->fetchAll(PDO::FETCH_CLASS, 'User');

		foreach ($users as $user) {

			if ($user->verification_token == $token)
			{
				 $que = $conn->query("UPDATE `db_camagru`.`users`
				 	SET `account_verified` = '1'
				 	WHERE `id`= '".$user->id."'");
				$_SESSION['account_verified'] = 1;
				echo $user->account_verified."|<br>";
				echo 'Account Verified. You can now enjoy full access user privileges';
				header('Location: home/index.php');
				break;
			}	
		}
		echo 'Token Incorrect : <br> <a href="account_verification.php"><input type ="button" value="Try Again"></a>';
?>