<?php
require("header.php");
require_once("common.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {
	echo '<form method="POST" action="login.php">';
	echo 'Username: <input type="text" name="username"><br><br>';
	echo 'Password: <input type="password" name= "password"><br><br>';
	echo '<button type="submit">Submit</button>';
	echo '</form>';
} else if($_SERVER["REQUEST_METHOD"] == "POST") {
	//sanity checks
	if($_POST["username"] == "admin" && $_POST["password"] == "pass") {
		$_SESSION["username"] = "admin";
		header("location:admin.php");
	} else if($_POST["username"] == "user" && $_POST["password"] == "pass") {
		$_SESSION["username"] = "user";
		header("location:events.php");
	} else {
		//come back
		session_destroy();
		$_SESSION = array();
		session_write_close();
		header("location: login.php");
		exit();
	}	
} else {
	exit("Unknown Error. Please contact an aministrator at: admin@email.com");
}

require("footer.php");