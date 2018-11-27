<?php
session_start();
include '../config/connect.php';
include_once '../classes/User.class.php';

$email = $_POST['email'];

if (!isset($_SESSION['id'])) {
	echo "You are actually not logged in!";
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

	$id = $_SESSION['id'];

	$sql = $conn->prepare("UPDATE `db_camagru`.`users` SET `e_mail` = :email WHERE `id` = :id");
	$sql->bindParam(':email', $email);
	$sql->bindParam(':id', $id);
	$sql->execute();
}

echo "Your new e-mail : ".$email."<br>
Your E-mail is important as it is also your login credentials. <br>
Contact the site administrator if you lose access to your account. : anistplenitud@gmail.com 
";

?>