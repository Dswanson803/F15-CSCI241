<?php
require("header.php");
require_once("common.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST["addToList"])) {

		addToList($_POST["addToList"]);
		
	} else if(isset($_POST["removeFromList"])) {
		
		removeFromList($_POST["removeFromList"]);
		
	}
	
}
eventList();
showList();

require("footer.php");