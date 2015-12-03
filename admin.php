<?php
require("header.php");
require_once("common.php");
if($_SESSION["username"] != "admin")
{
	exit("Page restricted");
}

eventList(); //Outputs list of events.

if($_SERVER["REQUEST_METHOD"] == "GET") 
{
	?>
	<h2>Add an Event:</h2>
	<form action="admin.php" method="POST">
			Event Name: <input type="text" name="event"><br><br>
			Event Location: <input type="text" name="location"><br><br>
		<button type="submit">Submit</button>
	</form>
	<?php
}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{	
	//Delete an event.
	if(isset($_POST["deleteEvent"])) {
		deleteLine("events.txt", $_POST["deleteEvent"]);
		header("location: admin.php");
	}
	//Add an event.
	else if(isset($_POST["event"])) 
	{
		$events = array();
		$events[] = $_POST["event"];
		$events[] = $_POST["location"];
		
		appendLine("events.txt", implode("|", $events) . "\r\n");
		header("Location: admin.php");
	}
	else 
	{
		header("Location: admin.php");
	}
}
else
{
	header("Location: index.php");
	exit();
}

require("footer.php");