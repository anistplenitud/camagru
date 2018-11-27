<?php
	session_start();

	session_unset();
	session_destroy();
	//include '../config/connect.php';
//	$que = $conn->query("UPDATE `db_camagru`.`users`
//				 	SET `account_verified` = '1'
//				 	WHERE `id`= '".$user->id."'");
	header('Location: ../');
?>