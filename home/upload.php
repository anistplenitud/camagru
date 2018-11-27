<?php
session_start();
include '../config/connect.php';
date_default_timezone_set('Africa/Johannesburg');
//$file = md5(uniqid()) . '.png';

$status = $_POST['status'];
$sticker = $_POST['sticker'];

$target_dir = "./";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

        /////
        $buffer_onto = imagecreatefrompng($target_file);
        $buffer_from = imagecreatefrompng($sticker);
        imagecopymerge($buffer_onto, $buffer_from, 0, 0, 0, 0, 640, 480, 60);

        imagepng($buffer_onto, $target_file);
        imagedestroy($buffer_onto);
        imagedestroy($buffer_from);

        /////

        echo "ID :".$_SESSION['id']."<br>".$_SESSION['name']."<br>".$_SESSION['surname']."<br>".$_SESSION['passwd']."<br>".$_SESSION['email']."<br>".$_SESSION['account_verified']."<br>".$_SESSION['verification_token'];
        $try = date('Y-m-d H:i:s', time());

        $sql = $conn->prepare("INSERT INTO `db_camagru`.`posts` (`id`, `user_id`, `image`, `post`, `date`) VALUES (NULL, :id, :file, :status, :try)");
        $sql->bindParam(':id', $_SESSION['id']);
        $sql->bindParam(':file', htmlentities($target_file));
        $sql->bindParam(':status', htmlentities($status));
        $sql->bindParam(':try', $try);
        $sql->execute();    

        header('Location: ./');  
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>