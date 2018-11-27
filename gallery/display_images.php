<?php
session_start();

include '../config/connect.php';
include '../classes/Post.class.php';
include '../classes/Like.class.php';
include '../classes/Comment.class.php';


if (!isset($_SESSION['latest_one']) || ($_POST['email'] != '4' && $_POST['email'] != '5')) {

	$sql = $conn->prepare("SELECT * FROM `db_camagru`.`posts` ORDER BY `date` DESC LIMIT 6");

}
else
{
	$sql = $conn->prepare("SELECT * FROM `db_camagru`.`posts` WHERE `id` < :id ORDER BY `date` DESC LIMIT 6");
	$sql->bindParam(':id', $_SESSION['latest_one']);
	if ($_POST['email'] == '4')
	{	
		$sql = $conn->prepare("SELECT * FROM `db_camagru`.`posts` WHERE `id` > :id ORDER BY `date` DESC LIMIT 6");
		$sql->bindParam(':id', $_SESSION['latest_one']);
	}
}


$sql->execute();
			//$que = $conn->query("SELECT * FROM `db_camagru`.`posts`");
$my_posts = $sql->fetchAll(PDO::FETCH_CLASS, 'Post');


foreach ($my_posts as $post) {
	$_SESSION['latest_one'] = $post->id;

	$sql = $conn->prepare("SELECT `db_camagru`.`likes`.`id`, `db_camagru`.`likes`.`user_id`, `db_camagru`.`likes`.`like_date`, `db_camagru`.`likes`.`post_id`, `db_camagru`.`users`.`name`, `db_camagru`.`users`.`surname` FROM `db_camagru`.`likes` INNER JOIN `db_camagru`.`users` ON `db_camagru`.`users`.`id` = `db_camagru`.`likes`.`user_id` WHERE `db_camagru`.`likes`.`post_id` = :post_id");
	$sql->bindParam(':post_id', $post->id);
	$sql->execute();

	$post_likes = $sql->fetchAll(PDO::FETCH_CLASS, 'Like');


	$sql = $conn->prepare("SELECT `db_camagru`.`comments`.`id`, `db_camagru`.`comments`.`user_id`, `db_camagru`.`comments`.`post_id`, `db_camagru`.`comments`.`comment`, `db_camagru`.`comments`.`comment_date`, `db_camagru`.`users`.`name`, `db_camagru`.`users`.`surname` FROM `db_camagru`.`comments` INNER JOIN `db_camagru`.`users` ON `db_camagru`.`users`.`id` = `db_camagru`.`comments`.`user_id` WHERE `db_camagru`.`comments`.`post_id` = :post_id");
	$sql->bindParam(':post_id', $post->id);
	$sql->execute();

	$post_comments = $sql->fetchAll(PDO::FETCH_CLASS, 'Comment');

	$liker = "like";
	if (isset($_SESSION['id']))
	{
		foreach ($post_likes as $like) {
			if ($like->user_id == $_SESSION['id'])
			{
				$liker = "liked";
			}
		}
		$special_line = "<input id = 'btn".$post->id."' type= 'button' value = '".$liker."' onclick = 'like()'>";
		$form_comment = "<form id = 'frm".$post->id."'>
							<input id = 'input".$post->id."' type= 'hidden' value = '".$post->id."'>
							<textarea name ='comment' maxlength='100' style='width:40vw;'></textarea> <br>
							<input id = 'btn".$post->id."' type= 'button' value = 'add comment' onclick = 'add_comment()'>
							</form>";
	}

	$img = "<img src = '../home/".$post->image."' style='border-radius:40%; width:30%; height:30%; '>";

	$form_like = "<form id = 'frm".$post->id."'>
	<input id = 'input".$post->id."' type= 'hidden' value = '".$post->id."'>".
	$special_line.
	"<label class='likes'>".sizeof($post_likes).
	" likes</label>"
	."</form>";	

	echo "<div class='post'>";
	echo "<div class='img_div'>".$img."<br>";
	echo "<p class='post_date' style='font-size:2vw;'>".$post->date."</p>";
	echo "<p class='post_text'>".$post->post."</p>";
	echo $form_like." </div>";

	echo "<div class = 'back'>";
	if (sizeof($post_comments) > 0) {
		echo "<input type='button' value ='hide/show ".sizeof($post_comments)." comments' style='width:80%;font-size:2vw;' onclick = 'togglecomments()'>";	
	}
	
	foreach ($post_comments as $comment) {
		echo "<div class = 'comments' style='display:none;'>";
		echo "<p class='comment_name'>".$comment->name." ".$comment->surname."</p>";
		echo "<span class='comment'>".$comment->comment."</span>";
		echo "<div class='comment_date'>".$comment->comment_date."</div>";
		echo "</div>";
	}
	echo $form_comment."<br></div>";
	echo "</div>";
}

	if (sizeof($my_posts) < 5 )
	{
		unset($_SESSION['latest_one']);
		echo "No more posts";
	}

unset($_POST['email']);

?>