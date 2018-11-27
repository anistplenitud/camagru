<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gallery</title>
	<link rel="stylesheet" type="text/css" href="gallery.css">
</head>
<body>
<div id ="logout">
	<?php
			if (isset($_SESSION['id']))
			{
				echo '<a href="../home/logout.php">
				<input type="submit" name="btn_logout" value="Log Out"></a>';
				echo '<a href="../profile"><input type = "button" value ="My profile"></a>
		<a href="../home"><input type = "button" value ="Home"></a>';
			}
	?>
<span id="logo">Camagru</span>
</div>

<div id="side_section"> 
		
		<div id="display">
		</div>
		<input id="left_nav" type="button" name="left_nav" value="<">
		<input id="right_nav" type="button" name="right_nav" value=">">
		<div id="footer">
	<p>&copy amampuru Camagru 2018 November &nbsp;</p>
</div>
</div>


</body>
</html>
<script type="text/javascript" src="../js/gallery.js"></script>