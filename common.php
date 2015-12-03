<?php
session_start();

//Checks is there is a session, and starts one otherwise.
//Checks if the session is correct, destroys otherwise.
if(!isset($_SESSION["ip"]))
{
	$_SESSION["ip"] = $_SERVER["REMOTE_ADDR"];	
}
else
{
	if($_SESSION["ip"] == $_SERVER["REMOTE_ADDR"])
	{
		//No problems
	}	
	else {
		session_destroy();
		$_SESSION = array();
		session_write_close();
		header("Location: login.php");
		exit();
	}
}

//Returns the data stored in the file passed.
function readLines($filename) 
{
	$fileResource = fopen($filename, "r");
	if(!is_resource($fileResource)) 
	{
		exit("Could not open the file for reading.");
	}
	$contents = array();
	while($line  = fgets($fileResource)) 
	{
		$contents[] = $line;
	}
	fclose($fileResource);
	return $contents;
}

//outputs the list of events from events.txt
function eventList() 
{
	$events = readLines("events.txt");
	echo "<h2>Current Events:</h2>";
	echo "<ul>";
	if(isset($_SESSION["username"])) {
		if($_SESSION["username"] == "admin")
		{
			foreach ($events as $lineNo => $line) 
			{
				$line = explode("|", $line);
				echo "<li>" . $line[0];
				echo " - " . $line[1] . "</li>";
				echo "</a>";
				echo "<form method='post' action='admin.php'>";
					echo "<input type=\"hidden\" name=\"deleteEvent\" value=\"$lineNo\">";
					echo "<button type='submit' >Delete</button>";
				echo "</form>";
				echo "<form method='post' action='events.php'>";
				echo "<input type=\"hidden\" name=\"addToList\" value=\"$lineNo\">";
				echo "<button type='submit' >Add</button>";
				echo "</form>";
			}
			echo "</li>";
			echo "</ul>";
			echo "</form>";
		} else {
			foreach ($events as $lineNo => $line) 
			{
				$line = explode("|", $line);
				echo "<li>" . $line[0];
				echo " - " . $line[1] . "</li>";
				echo "</a>";
				echo "<form method='post' action='events.php'>";
				echo "<input type=\"hidden\" name=\"addToList\" value=\"$lineNo\">";
				echo "<button type='submit' >Add</button>";
				echo "</form>";
			}
			echo "</ul>";
		}
	} 
	else 
	{
		foreach ($events as $lineNo => $line) 
		{
			$line = explode("|", $line);
			echo "<li>" . $line[0];
			echo " - " . $line[1] . "</li>";
			echo "</a>";
			echo "<form method='post' action='events.php'>";
		}
		echo "</ul>";
		echo "</form>";
	}
}

//adds the event passed($line) to the file passed($filename).
function appendLine($filename, $line)
{
	$fileResource = fopen($filename, "a");
	
	if(!is_resource($fileResource))
	{
		exit("File not found.");
	}
	
	fwrite($fileResource, $line);
	
	fclose($fileResource);
	
	return null;
	
}

//remove an event ($line) from the file($filename)
function deleteLine($filename, $line)
{
	$contents = readLines($filename);
		
	unset($contents[$line]);

	$fileResource = fopen($filename, "w");
		
	if(!is_resource($fileResource))
	{
		exit("Could not open the file for reading.");
	}
	
	$content[] = implode("|", $line);
	
	foreach($contents as $contentLine)
	{
		fwrite($fileResource, $contentLine);
	}	
	
	fclose($fileResource);
	
	return null;
	
}

function addToList($event) {
	if(isset($_SESSION["list"])) {
		if (!in_array($event, $_SESSION["list"])) {
			$_SESSION["list"][] = $event;
		}
	} else {
		$_SESSION["list"] = array();
		if (!in_array($event, $_SESSION["list"])) {
			$_SESSION["list"][] = $event;
		}
	}
}

function showList() {
	if(isset($_SESSION["list"])){
		echo "<br>";
		echo "<h2>Your List:</h2>";
		echo "<ul>";
		
		$contents = readLines("events.txt");
		
		foreach($_SESSION["list"] as $value) {
			$line = explode("|", $contents[$value]);
			echo "<li>" . $line[0] . " - " . $line[1] . "<br></li>";
			echo "<form method='post' action='events.php'>";
			echo "<input type=\"hidden\" name=\"removeFromList\" value=\"$value\">";
			echo "<button type='submit' >Remove</button>";
			echo "</form>";
		}
		echo "</ul>";
		echo "<a href='mail.php'>Send your list to yourself, or a friend!</a>";
	}
}

function removeFromList($event) {
	$key = array_search($event, $_SESSION["list"]);
	unset($_SESSION["list"][$key]);
}


function sendMail($from, $to, $subject) {
	$headers = "From: " . $from . "\r\n";
	$headers .= "Content-Type: text/html";
	$content = readLines("events.txt");
	$body = "<ul>";
	
	foreach($_SESSION["list"] as $value) {
		$line = explode("|", $content[$value]);
		$body .= "<li>" . $line[0] . " - " . $line[1] . "<br></li>";
	}
	
	$body .= "</ul>";
	mail($to, $subject, $body , $headers);
}
