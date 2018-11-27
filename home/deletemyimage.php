<?php

include '../config/connect.php';

$data = explode("|", $_POST['image_info']);

$image_id = $data[0];
$image_name = $data[1];

if (!$data[0]) {
	header('Location: ./');
}

if (!unlink($image_name))
  {
  echo ("Error deleting $data[0]");
  }
else
{
  	$sql = $conn->prepare("DELETE FROM `db_camagru`.`posts` WHERE `id`= :id");
	$sql->bindParam(':id', $data[0]);
	$sql->execute();
  	echo ("Deleted $data[1]");
}

?>