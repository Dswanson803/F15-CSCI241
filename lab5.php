<!DOCTYPE html>
<html>
	<head>
		<title>Part One | Lab5</title>
		<link href="css.css" type="text/css" rel="stylesheet">
	</head>
		<body>
		<?php
			if($_SERVER["REQUEST_METHOD"] == "GET")
			{
				?>
				<h1>Pay Calculator</h1>
				<form method="POST" action="lab5.php">
				<table class="get-table">
					<tr><td>ID: </td><td><input type="text" name="employeeId"></td></tr>
					<tr><td>Name: </td><td><input type="text" name="employeeName"></td></tr>
					<tr><td>Hourly Wage: </td><td><input type="text" name="hourlyWage"></td></tr>
					<tr><td>Hours Worked: </td><td><input type="text" name="hoursWorked"></td></tr>
				</table>
					<input type="submit" value="Submit" class="button">
				</form>
			<?php
			} else if($_SERVER["REQUEST_METHOD"] == "POST") {
				$employeeId = $_POST["employeeId"];
				$employeeName = $_POST["employeeName"];
				$hourlyWage = $_POST["hourlyWage"];
				$hoursWorked = $_POST["hoursWorked"];
				
				echo "<h1>Paystub</h1>"; //page title
				echo "<p>Name: " . $employeeName . "</p>";
				echo "<p>ID: " . $employeeId . "</p>";
				
				if(is_numeric($hourlyWage) && is_numeric($hoursWorked))
				{
					$overTime = overTimeHours($hoursWorked);
					$finalPay = finalPay($hoursWorked, $overTime, $hourlyWage);
					payStub($hoursWorked, $overTime, $hourlyWage, $finalPay);
					disbursmentTable($finalPay, $finalPay);
				} else {
					echo "<h2>Please enter valid data.</h2>";
				}
			}
			
			//call with $overTime = overTimeHours($hoursWorked);
			function overTimeHours($hoursWorked) {
				if ($hoursWorked > 40) {
					return ($hoursWorked - 40);
				}
				else {
					return 0;
				}
			}
			
			//call with $finalPay = finalPay($hoursWorked, $overTime, $hourlyWage);
			function finalPay($hours, $overTimeHours, $hourlyWage) {
				return ((($hours - $overTimeHours) * $hourlyWage) + ($overTimeHours * ($hourlyWage*1.5)));
			}
			
			//call with payStub($hours, $overTimeHours, $hourlyWage, $finalPay);
			function payStub($hours, $overTimeHours, $hourlyWage, $finalPay) {
				echo "<table>";
				echo "<tr><th></th><th>Hours</th><th>Gross Pay</th></tr>";
				echo "<tr><td>Regular:</td><td>" . ($hours-$overTimeHours) . "</td><td>$" . ($hours-$overTimeHours)*$hourlyWage . "</td></tr>";
				echo "<tr><td>Overtime:</td><td>" . $overTimeHours . "</td><td>$" . ($hourlyWage*1.5)*$overTimeHours . "</td></tr>";
				echo "<tr><td>Total:</td><td>" . $hours . "</td><td>$" . $finalPay . "</td></tr>";				
				echo "</table>";
			}
			
			//call with disbursmentTable($finalPay, $finalPay);
			function disbursmentTable($amount, $finalPay) {
				echo "<h2>Disbursment</h2>";//table title
				echo "<table>"; //table start
				echo "<tr><th>Denomination</th><th>Qty</th><th>Disbursed</th></tr>";//table header
				
				$money = array( 100, 50, 20, 10, 5, 1, .25, .10, .05, .01 ); //Stores disbursment options

				for ( $x = 0; $x < count($money); $x++) //cycles through $money array
				{
					$counter = 0; //Resets counter for each array element
					while ( $amount >= $money[$x] ) //Makes sure that enough money remains
					{
						$amount -= $money[$x];
						$counter++;
					}
					echo '<tr><td>$' . $money[$x] . "</td><td>" . $counter . "</td><td>$" . ($money[$x] * $counter) . "</td></tr>";
				}
				echo "<tr><td>Total:</td><td></td><td>$" . $finalPay . "</td></tr>";
				echo "</table>"; //table end
			}
			?>
		</body>
</html>