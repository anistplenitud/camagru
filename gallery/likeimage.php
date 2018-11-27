<?php
session_start();
date_default_timezone_set('Africa/Johannesburg');

include '../config/connect.php';

$post_id = $_POST['image_info'];
$user_id = $_SESSION['id'];
$like_date = date('Y-m-d H:i:s', time());

if (!$post_id) {
	header('Location: ./.');
}

$sql = $conn->prepare("INSERT INTO `db_camagru`.`likes` (`id`, `user_id`, `like_date`, `post_id`) VALUES (NULL, :user_id, :like_date, :post_id)");
$sql->bindParam(':user_id', $user_id);
$sql->bindParam(':like_date', $like_date);
$sql->bindParam(':post_id', $post_id);
$sql->execute();

$sql = $conn->prepare("SELECT COUNT(*) AS `nlikes` FROM `db_camagru`.`likes` WHERE `post_id` = :post_id");
$sql->bindParam(':post_id', $post_id);
$sql->execute();

$nlikes = $sql->fetch();

echo $nlikes[0]." likes";

?>