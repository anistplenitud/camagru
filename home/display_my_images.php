<?php
session_start();

include '../config/connect.php';
include '../classes/Post.class.php';

$sql = $conn->prepare("SELECT * FROM `db_camagru`.`posts` WHERE `user_id`= :id ORDER BY `date` DESC");
$sql->bindParam(':id', $_SESSION['id']);
$sql->execute();
			//$que = $conn->query("SELECT * FROM `db_camagru`.`posts`");
$my_posts = $sql->fetchAll(PDO::FETCH_CLASS, 'Post');

foreach ($my_posts as $post) {

//print_r($post);

$img = "<img src = '../home/".$post->image."' style='border-radius:40%; width:30%; height:30%; '>";

$form = "<form id = 'frm".$post->id."' action='deletemyimage.php' method='POST'>
<input id = 'input".$post->id."' type= 'hidden' value = '".$post->id."|".$post->image."'>
<input id = 'btn".$post->id."' type= 'button' style='background-color:#69191C; color:whitesmoke;' value = 'delete' onclick = 'remove()'>
</form>";

echo "<div>".$img."<br>";
echo "<p style='font-family : Arial; font-size : 0.8vh'>".$post->date."</p>";
echo "<p style='font-family : Sans-Serif;'>".$post->post."</p>";
echo $form."<br> </div>";

}

echo "<hr>";
?>