<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<LINK rel = "stylesheet" type = "text/css" href = "menu.css">
</head>
<body>
	<div id ="logout">
			<a href="../home/logout.php"><input type="button" name="btn_logout" value="Log Out"></a>
			<a href="../home"><input type="button" name="home" value="home"></a>
			<span>Camagru</span>
	</div>
	<br>
	<DIV id = "dropdown">

		<label id="options">Change PassWord</label>
		<ul id ="options_ul">
			<li><form id="new_pass" method="POST" action="newpassword.php">
				Enter Old PassWord / Reset Token: <br>
				<input id="reset_token" type="password" name="reset_token" value="<?php echo $_GET['token']; ?>" autocomplete> <br>
				Enter New PassWord : <br>
				<input id="passwd" type="password" name="passwd" required autocomplete> <br>
				Confirm Password : <br>
				<input id="c_passwd" type="password" name="c_passwd" required autocomplete=""> <br>
				<input id="email" type="hidden" name="email" value="<?php echo $_GET['email']; ?>" ><br>
				<input type="button" name="submit" onclick="requestpasschange()" value="submit">
			</form>
			</li>
		</ul>
		<div id="demo">
		</div>
	</DIV>
<?php
	$m = '
	<DIV id = "dropdown2">
		<label id="options2">Change E-mail</label>
		<ul id ="options_ul2">
			<li>
				<form id="new_email" method="POST" action="newemail.php">
					Enter New E-mail : <br>
					<input id="email_c" type="email" name="email"><br>
					Confirm E-mail : <br>
					<input id="email_cc" type="email" name="v_email"> <br>

					<input type="button" name="submit" onclick="requestemailchange()" value="submit">
				</form>
			</li>
		</ul>
		<div id="demo2">
		</div>
	</DIV>';


	if (isset($_SESSION['email_notif'])) {
		if ($_SESSION['email_notif'] == TRUE)
		{
			$check = 'checked';
			$value = '0';
		}
		else
		{
			$value = '1';
		}
	}

	$html ='
	<DIV id = "dropdown3">
		<label id="options3">Notification Settings</label>
		<ul id ="options_ul3">
			<li>
				<form id="notification_change" method="POST" action="emailnotfications.php">
					<input id="notif_choice" value="'.$value.'" type="checkbox"'.$check.' name="submit" onchange="notificationchange()">Recieve E-mail when someone comments on your post
				</form>
			</li>
		</ul>
		<div id="demo3">
		</div>
	</DIV>

	<DIV id = "dropdown4">
		<label id="options4">Change Details</label>
		<ul id ="options_ul4">
			<li>
				<form id="new_details">
					Enter New Name : <br>
					<input id="name" type="email" name="name"><br>
					Enter New Surname : <br>
					<input id="surname" type="text" name="surname"> <br>
					<input type="button" name="submit" onclick="requestdetailchange()" value="submit">
				</form>
			</li>
		</ul>
		<div id="demo4">
		</div>
	</DIV>

	';

	if (isset($_SESSION['id'])) {
		echo $m;
		echo $html;
	}
	?>
	<div id="footer">
		<p>&copy amampuru Camagru 2018 November &nbsp;</p>
	</div>
</body>
</html>
<script type="text/javascript" src="../js/profile.js"></script>