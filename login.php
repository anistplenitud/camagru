<?php
session_start();

include 'config/connect.php';
include 'classes/User.class.php';

date_default_timezone_set('Africa/Johannesburg');
if (!isset($_POST['e_mail']) || !isset($_POST['password'])) {
	header('Location: ./');
}
$e_mail = $_POST['e_mail'];
$passwd = $_POST['password'];

$que = $conn->query('SELECT * FROM `db_camagru`.`users`');

$users = $que->fetchAll(PDO::FETCH_CLASS, 'User');

foreach ($users as $user) {
	if ($user->e_mail == $e_mail && $user->password == hash('whirlpool', $passwd))
	{
		$try = date('Y-m-d H:i:s', time());
		$que = $conn->query("UPDATE `db_camagru`.`users`
				 	SET `last_login` = '".$try."'
				 	WHERE `id`= '".$user->id."'");

		
		echo "Succesful Login!";
			$_SESSION['id'] = $user->id;
			$_SESSION['name'] = $user->name;
			$_SESSION['surname'] = $user->surname;
			$_SESSION['passwd'] = $user->password;
			$_SESSION['email'] =  $user->e_mail;
			$_SESSION['account_verified'] =  $user->account_verified;
			$_SESSION['verification_token'] = $user->verification_token;
			$_SESSION['email_notif'] = $user->email_notif;

		header('Location: home/');	
		exit(0);
	}	
}
	echo "Incorrect Login Credentials";
	session_destroy();
?>