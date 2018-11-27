<?php
session_start();
include '../config/connect.php';
include_once '../classes/User.class.php';

$newpass = $_POST['c_passwd'];
$email = $_POST['email'];
$reset = $_POST['reset_token'];

$que = $conn->query('SELECT * FROM `db_camagru`.`users`');
$users = $que->fetchAll(PDO::FETCH_CLASS, 'User');

if (!isset($_SESSION['id'])) {
	foreach ($users as $user) {
		if ($user->e_mail == $email)
		{
			$id = $user->id;
			$_SESSION['id'] = $id;
			$_SESSION['name'] = $user->name;
			$_SESSION['surname'] = $user->surname;
			$_SESSION['passwd'] = $user->password;
			$_SESSION['email'] =  $user->e_mail;
			$_SESSION['account_verified'] =  $user->account_verified;
			$_SESSION['verification_token'] = $user->verification_token;
			$_SESSION['email_notif'] = $user->email_notif;
			echo "You are now logged in!";
			break;
		}	
	}
}
else
{
	$id = $_SESSION['id'];

}



$sql = $conn->prepare("UPDATE `db_camagru`.`users` SET `password` = :newpass WHERE `id`= :id");
$sql->bindParam(':newpass', hash('whirlpool', $newpass));
$sql->bindParam(':id', $id);
$sql->execute();


?>