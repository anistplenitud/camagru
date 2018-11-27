<?php
session_start();
include '../config/connect.php';

$data = $_POST['data'];
$status = $_POST['status'];
$sticker = $_POST['sticker'];

if ($data) {

	$file = md5(uniqid()) . '.png';
	date_default_timezone_set('Africa/Johannesburg');

// remove "data:image/png;base64,"
	$uri =  substr($data,strpos($data,",") + 1);

// save to file
	file_put_contents($file, base64_decode($uri));

	$buffer_onto = imagecreatefrompng($file);
	$buffer_from = imagecreatefrompng($sticker);
	imagecopymerge($buffer_onto, $buffer_from, 0, 0, 0, 0, 640, 480, 50);

	imagepng($buffer_onto, $file);
	imagedestroy($buffer_onto);
	imagedestroy($buffer_from);

	$try = date('Y-m-d H:i:s', time());

	$sql = $conn->prepare("INSERT INTO `db_camagru`.`posts` (`id`, `user_id`, `image`, `post`, `date`) VALUES (NULL, :id, :file, :status, :try)");
		$sql->bindParam(':id', $_SESSION['id']);
		$sql->bindParam(':file', htmlentities($file));
		$sql->bindParam(':status', htmlentities($status));
		$sql->bindParam(':try', $try);
		$sql->execute();	
}



header('Location: ./');	
?>



