<?php

	session_name('myHCMS');
	session_start();
	ini_set("display_errors","0");
	date_default_timezone_set('Asia/Kolkata');

	header('X-Frame-Options: SAMEORIGIN');
	header('X-XSS-Protection: 1; mode=block');
	header('X-Content-Type-Options: nosniff');
	header_remove("X-Powered-By");
	
	$day = new DateTime('+1 day');
	setcookie('key', 'value', $day->getTimeStamp(), '/', null, true, true);
	
	function htmlspecialchars_recursive($input) {
		static $flags, $encoding, $double_encode;
		if (is_array($input)) {
			return array_map('htmlspecialchars_recursive', $input);
		}
		else if (is_scalar($input)) {
			return htmlspecialchars($input);
		}
		else {
			return $input;
		}
	}
	
	$_GET = htmlspecialchars_recursive($_GET);
	
	$_POST = htmlspecialchars_recursive($_POST);
	
	if(!@$_SESSION['id'])
	{
		if (strpos($_SERVER['REQUEST_URI'], 'index.php') !== false || $_SERVER['REQUEST_URI'] == '/order_tracking_dataentry/')
			header("Location:login.php");
		else if (strpos($_SERVER['REQUEST_URI'], 'login.php') === false)
		{
			echo "Invalid session";
			
			exit;
		}
	}
	
	if ($_SERVER['REQUEST_METHOD']=='POST' && strpos($_SERVER['REQUEST_URI'], 'login.php') === false)
	{
		if (!isset($_POST["token"]) || $_SESSION["token"] == null || $_SESSION["token"] == "" || $_SESSION["token"] != $_POST["token"])
		{
			echo "Invalid session";
			
			exit;
		}
	}
	
	$dbcon = mysqli_connect("localhost", "root", "", "user_registration") or die("Could not connect to Database");
?>