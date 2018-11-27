<?php

	session_start();

	$choice = "";
	if (isset($_POST["button_1"]))
	{
		$choice = $_POST["button_1"];
	}
	if (!$choice) {
		if (isset($_POST["button_2"]))
		{
			$choice = $_POST["button_2"];
		}
			
	}

	if ($choice == "Yes") {
		echo $_SESSION['choice'];
		$_SESSION['choice'] = 'droplikeitshot';
		header('Location: setup.php');
	}
	else
	{
		echo "alright, you can proceed to site";
	}
	
?>