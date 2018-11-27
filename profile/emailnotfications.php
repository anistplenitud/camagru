<?php
session_start();
include '../config/connect.php';
//include_once 'classes/User.class.php';

$choice = $_POST['choice'];

if (!isset($_SESSION['id'])) {
	echo "You are actually not logged in!";
	exit();
}
else
{
	$id = $_SESSION['id'];

	$sql = $conn->prepare("UPDATE `db_camagru`.`users` SET `email_notif` = :choice WHERE `id` = :id");
	$sql->bindParam(':choice', $choice);
	$sql->bindParam(':id', $id);
	$sql->execute();
}

echo "Your Settings Have Been Updated!";
echo $id;

?>