<?php
session_start();
include '../config/connect.php';

$name = $_POST['name'];
$surname = $_POST['surname'];

if (!isset($_SESSION['id'])) {
	echo "You are actually not logged in!";
	exit();
}
else
{
	$id = $_SESSION['id'];
	$sql = $conn->prepare("UPDATE `db_camagru`.`users` SET `name` = :name, `surname` = :surname WHERE `id` = :id");
	$sql->bindParam(':name', $name);
	$sql->bindParam(':surname', $surname);
	$sql->bindParam(':id', $id);
	$sql->execute();
}

echo "Your new details are : ".$name." ".$surname."<br>";

?>