<?php
require_once("common.php");
?>
<!doctype html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="events.php">Events</a></li>
				<?php
				if(isset($_SESSION["username"])) {
					if($_SESSION["username"] =="admin") {
						echo '<li><a href="admin.php">Admin</a></li>';
						echo '<li><a href="logout.php">Logout</a></li>';
					} else {
						echo '<li><a href="logout.php">Logout</a></li>';
					}
				} else {
						echo '<li><a href="login.php">Login</a></li>';
				}
				?>
			</ul>
		</nav>