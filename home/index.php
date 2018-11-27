<?php
session_start();
include '../config/connect.php';
include '../classes/User.class.php';

if (!isset($_SESSION['account_verified'])) {
		header('Location: ../.');	
}
else if ($_SESSION['account_verified'] == 0) {
		header('Location: ../account_verification.php');	 
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Camagru</title>
	<link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
<div id ="logout">
			<a href="../home/logout.php"><input id="logout_btn" type="button" value="Log Out"></a>
			<a href="../profile"><input type="button" value ="My profile"></a>
			<a href="../gallery"><input type = "button" value ="Gallery"></a>
			<span style="text-align: right; position: absolute;right: 0%;font-size: 2vw; top: 1%;">Camagru</span>
</div>
	<div id = "home">
		
		
		<div id="screenshot" style="width: 50vw; border: 1px solid blue; height:60vh;">
			<video autoplay style="width: 30vw; height: 30vh;"></video>
			<br>
			<input type="button" name="screenshot-button" id="screenshot-button" value="take pic">
			<br>
			<img id="preview" src="" alt="" style="width: 30vw">
			<img id="stickers_preview" alt="" style="width: 30vw">
			<canvas style="display: none;"></canvas>
			
		</div>
	</div>
	<div style="width: 50%;">
		<form id="frm_selfie" action="saveimage.php" method="POST">
			<textarea id="status" name="status" placeholder="Describe your photo here..." maxlength="100" style="resize: none;width: 30vw;"></textarea>
			<input id="frm_selfie_sticker" type="hidden" name="sticker" value="">
			<textarea id="hidden_img" name="data" style="display: none;"></textarea>
			<input id="btn" type="submit" name="btn_saveimg" style="display: none; background-color: #66CD00; color: whitesmoke;" value="post">
		</form>
	</div>
	<div style="width: 50%;">
		<form id="frm_upload" action="upload.php" method="post" enctype="multipart/form-data">
    	take selfie or upload file:
    		<input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" oninput="previewImg(event)">
    		<input id="frm_upload_sticker" type="hidden" name="sticker" value="">
    		<input id='btn2' type="submit" style="background-color: #66CD00; color: whitesmoke;display: none;" value="post"  name="submit">
    		<textarea id="status2" name="status" maxlength="100" style="resize: none;display: none;"></textarea>
		</form>
	</div>
	<div id="side_section" style=""> 
		<input id="left_nav" type="button" name="left_nav" value="Manage Posts">
		<div id="display">
			
		</div>
	</div>
	<div id="stickers_div">
		<span>Choose a sticker :</span>
		<div>
			<img id="sticker_1" src="stickers/1.png" onclick="loadmask()">
		</div>
		<div>
			<img id="sticker_2" src="stickers/2.png" onclick="loadmask()">
		</div>
		<div>
			<img id="sticker_3" src="stickers/3.png" onclick="loadmask()">
		</div>
		<div>
			<img id="sticker_4" src="stickers/4.png" onclick="loadmask()">
		</div>
		<div>
			<img id="sticker_5" src="stickers/5.png" onclick="loadmask()">
		</div>
		<div>
			<img id="sticker_6" src="stickers/6.png" onclick="loadmask()">
		</div>
		<div>
			<img id="sticker_7" src="stickers/7.png" onclick="loadmask()">
		</div>		
	</div>
	<div id="footer">
		<p>&copy amampuru Camagru 2018 November &nbsp;</p>
	</div>
</body>
</html>

<script type="text/javascript" src="../js/selfie.js"></script>