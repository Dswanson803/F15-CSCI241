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
					<tr><td>Start Value: </td><td><input type="number" name="start"></td></tr>
					<tr><td>End Value: </td><td><input type="number" name="end"></td></tr>
				</table>
					<input type="submit" value="Submit" class="button">
				</form>
			<?php
			} else if($_SERVER["REQUEST_METHOD"] == "POST") {
				$end = (int) $_POST["end"];
				$start = (int) $_POST["start"];
				if (is_int($start) && is_int($end)) {
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
				}
				else {
					echo "Please enter valid integers.";
				}
			}
			?>
		</body>
</html>