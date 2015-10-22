<!DOCTYPE html>
<html>
	<head>
		<title>Times Tables | Lab4</title>
		<link href="css.css" type="text/css" rel="stylesheet">
	</head>
		<body>
		<?php
			if($_SERVER["REQUEST_METHOD"] == "GET")
			{
				?>
				<h1>Times Table Generator</h1>
				<form method="POST" action="lab4.php">
				<table class="get-table">
					<tr><td>Start Value: </td><td><input type="text" name="start"></td></tr>
					<tr><td>End Value: </td><td><input type="text" name="end"></td></tr>
				</table>
					<input type="submit" value="Submit" class="button">
				</form>
			<?php
			} else if($_SERVER["REQUEST_METHOD"] == "POST") {
				if($_POST["start"] > $_POST["end"]){
					$end = $_POST["start"];
					$start = $_POST["end"];
					$difference = $end - $start;
				} else {
					$end = $_POST["end"];
					$start = $_POST["start"];
					$difference = $end - $start;
				}
				if(is_numeric($start) && is_numeric($end) && $difference < 100) {
					$test = (int) $start;
					$test2 = (int) $end;
					if($test == $start && $end == $test2){
							echo "<h1>Times Table Generator</h1>"; //page title
							echo "<table class='post-table'>"; //table start
							echo "<tr>";
							echo "<td class='special'> </td>";
							for ($x = $start; $x <= $end; $x++){ //header row
								echo "<td class='special'>" . $x . "</td>";
							}
							echo "</tr>";
							for ($x = $start; $x <= $end; $x++){ //header column
								echo "<tr><td class='special'>" . $x . "</td>";
								for ($y= $start; $y <= $end; $y++){ //table data
									echo "<td>" . ($x * $y) . "</td>";
								}
								echo "</tr>";
							}
							echo "</table>";
					} else {
						echo "Please enter valid integers.";
					}
				} else {
					echo "Please enter valid integers.";
				}
			}
			?>
		</body>
</html>