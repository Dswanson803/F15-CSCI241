<?php

	$grades = array(
		"Andrew" => array("test1" => 88, "hw1" => 92, "hw2" => 75, "midterm" => 97),
		"Bob" => array("test1" => 79, "hw1" => 84, "hw2" => 91, "midterm" => 85),
		"Alice" => array("test1" => 70, "hw1" => 60, "hw2" => 80, "midterm" => 95)
	);


function outputList() {
	
	$grades = array(
		"Andrew" => array("test1" => 88, "hw1" => 92, "hw2" => 75, "midterm" => 97),
		"Bob" => array("test1" => 79, "hw1" => 84, "hw2" => 91, "midterm" => 85),
		"Alice" => array("test1" => 70, "hw1" => 60, "hw2" => 80, "midterm" => 95)
	);
	
	foreach($grades as $lineNo => $line) {
		
		echo "Showing grades for " . $lineNo . "<br>";

		foreach ($line as $assignment => $grades) {
			echo $assignment . ": ";
			echo $grades . "<br>";
		}
		echo "<br>";
	}
	
	
	
}

function averageScore($grades, $assignment)
{
	
	$counter = 0;
	if ($assignment = "test1") {
		
		forEach($grades as $lineNo => $line) {
			foreach($line as $grade) {
				
				$counter += $grade;
			}
		}
		return $counter;
	}
	
}

?>

<!DOCTYPE html>
<html>
	
	<head>
		<title>
			It's 8AM
		</title>
	</head>
	
	<body>
		
		<?php
		
		outputList();
		averageScore($grades, 'test1');
		
		?>
		
	</body>
	
</html>