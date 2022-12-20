<?php
	function login($username, $password)
	{
		global $dbcon;
		return mysqli_query($dbcon, "Select * from users Where username = '".mysqli_real_escape_string($dbcon, $username)."' && password = '".mysqli_real_escape_string($dbcon, $password)."' && is_active=1");
	}
?>