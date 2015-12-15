<?php

session_start();

//adds number to their lotto list.
function addToList($number) {
	
	if(isset($_SESSION["list"]) && count($_SESSION['list']) <= 4) {
		if (!in_array($number, $_SESSION["list"])) {
			$_SESSION["list"][] = $number;
		}
	} else if(isset($_SESSION["list"]) && count($_SESSION['list']) > 4) {
		
		echo "List is full.";
		
	} else {
		$_SESSION["list"] = array();
		if (!in_array($number, $_SESSION["list"])) {
			$_SESSION["list"][] = $number;
		}
	}
}

//removes number from their lotto list.
function removeFromList($number) {
	$key = array_search($number, $_SESSION["list"]);
	unset($_SESSION["list"][$key]);
}

//lotto game
function playLotto() {
	
	//games played counter
	if(isset($_SESSION["gamesPlayed"])) {
			
		$_SESSION["gamesPlayed"] += 1;
		echo $_SESSION["gamesPlayed"];
			
	} else {
		
		$_SESSION["gamesPlayed"] = 0;
		echo $_SESSION["gamesPlayed"];
	}

	//determines correct guesses.
	$lottoCounter = 0;
	$winNums = array(5, 4, 3, 6, 2);
	for ($x = 0; $x <= 4; $x++) {
		
		if ( $_SESSION["gamesPlayed"][$x] == $winNums[$x] ) {
			
			$lottoCounter++;
			
		}
		
	}
	
	echo "You got " . $lottoCounter . "correct";
	
	
	//tracks wins and loses
	if ($lottoCounter > 0) {
			
		if(isset($_SESSION["gamesWon"])) {
			
			$_SESSION["gamesWon"] += 1;
			
		} else {
			
			$_SESSION["gamesWon"] = 1;
			
		}
		
	} else {
		
		if(isset($_SESSION["gamesLost"])) {
				
			$_SESSION["gamesLost"] += 1;
				
		} else {
			
			$_SESSION["gamesLost"] = 1;
			
		}
		
	}
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>It's 9:30ish</title>
</head>
<body>

<h1>Never Lucky Lotto</h1>
<p>Gimme your money.</p>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
	 
	 	//add a number
		if(isset($_POST["addToList"])) {
			
			addToList($_POST["addToList"]);
		
		//remove a number
		} else if(isset($_POST["removeFromList"])) {
		
			removeFromList($_POST["removeFromList"]);
		
		} else if(isset($_POST["playLotto"])) {
		
			playLotto();
		
		}
}

?>

<h2>Chosen Numbers</h2>
<ul>
	<?php
		
		foreach($_SESSION["list"] as $value) {
		
			echo "<li>" . $value;
			echo "<form method='post' action='index.php'>";
			echo "<input type=\"hidden\" name=\"removeFromList\" value=\"$value\">";
			echo "<button type='submit' >Remove</button>";
			echo "</form>";
		}
	
	?>
</ul>

<h2>Number Selection</h2>
<table>
<tr>
<?php
$totalLottoNumbers = 6;
$numbersPerRow = 3;

	for($ct = 1; $ct <= $totalLottoNumbers; $ct++)
	{
		echo "<td>";

		echo "<form method='post' action='index.php'>";
		echo "<input type=\"hidden\" name=\"addToList\" value=\"$ct\">";
		echo "<button type='submit' >$ct</button>";
		echo "</form>";

		echo "</td>";

		if($ct%$numbersPerRow==0 && $ct != $totalLottoNumbers )
		{
			echo "</tr><tr>";
		}
	}
?>
</tr>
</table>

<h2>Play the Lotto</h2>
<?php

		echo "<form method='post' action='index.php'>";
		echo "<input type=\"hidden\" name=\"playLotto\" value='1'>";
		echo "<button type='submit' >Play</button>";
		echo "</form>";

?>

</body>
</html>