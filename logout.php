<?php
require("header.php");
require_once("common.php");

session_destroy();
$_SESSION = array();
session_write_close();
header("Location: login.php");
exit();
		
require("footer.php");