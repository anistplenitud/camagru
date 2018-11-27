<?php
session_start();

date_default_timezone_set('Africa/Johannesburg');

include '../config/connect.php';
include '../classes/Post.class.php';

$post_id = $_POST['image_info'];
$comment = htmlentities($_POST['comment']);
$user_id = $_SESSION['id'];

if (!$post_id) {
	header('Location: ./.');	
}


//remember to check for POST['submit'] and SESSION['id'] set 
$comment_date = date('Y-m-d H:i:s', time());

$sql = $conn->prepare("INSERT INTO `db_camagru`.`comments` (`id`, `user_id`, `post_id`, `comment`, `comment_date`) VALUES (NULL, :user_id, :post_id, :comment, :comment_date)");
$sql->bindParam(':user_id', $user_id);
$sql->bindParam(':comment', $comment);
$sql->bindParam(':comment_date', $comment_date);
$sql->bindParam(':post_id', $post_id);
$sql->execute();

$sql = $conn->prepare("SELECT `db_camagru`.`posts`.`id`, `db_camagru`.`users`.`email_notif`, `db_camagru`.`users`.`e_mail`  FROM `db_camagru`.`posts` INNER JOIN `db_camagru`.`users` ON `db_camagru`.`users`.`id` = `db_camagru`.`posts`.`user_id`  WHERE `db_camagru`.`posts`.`id` = :post_id");

$sql->bindParam(':post_id', $post_id);
$sql->execute();

$posts = $sql->fetchAll(PDO::FETCH_CLASS, 'Post_Notif');

if ($posts[0]->email_notif == 1 && $posts[0]->e_mail != $_SESSION['email']) {
	$msg = "<!DOCTYPE html>
		<html>
		<head>
			<title>New Comment on Camagru !</title>
		</head>
		<body>
		<H1> Hello! You have a fan!</H1>
		<p>".$_SESSION['name']." says ".$comment
		."<br><a href='http://localhost:8080/Camagru/'>Log In</a> to see more of your fans. 
		</p> 
		</body>
		</html>";
		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		// send email
		mail($posts[0]->e_mail,"You have a new comment on your post!",$msg, implode("\r\n", $headers));
} 
echo $comment;

?>
