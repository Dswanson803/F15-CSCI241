<?php
require("header.php");
require_once("common.php");
?>

<form method="post" name="email" action="mail.php">
	From: <input type="text" name="from"> <br>
	To: <input type="text" name="to"> <br>
	Subject: <input type="text" name="subject"><br>
	<input type="submit" value="Send">
</form>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
	sendMail($_POST['from'], $_POST['to'], $_POST['subject']);
}


require("footer.php");