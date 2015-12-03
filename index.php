<?php
require("header.php");
require_once("common.php");
if (isset($_SESSION['username'])) {
	echo "<h1>Welcome {$_SESSION['username']}</h1>";
} else {
	echo "<h1>Welcome, please login</h1>";
}
?>

Welcome home.

<?php
require("footer.php");