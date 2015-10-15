<!DOCTYPE html>
<html>
	<head>
		<title>Part Two | Lab5</title>
		<link href="css.css" type="text/css" rel="stylesheet">
	</head>
	<body>
	<?php
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{ ?>
			<h1>Pay Calculator</h1>
			<form method="POST" action="lab5p2.php">
			<table class="get-table">
				<tr><td>Total Bill: </td><td><input type="text" name="bill"></td></tr>
				<tr><td>Tendered: </td><td><input type="text" name="tendered"></td></tr>
			</table>
				<input type="submit" value="Submit" class="button">
			</form>
		<?php
		} else if($_SERVER["REQUEST_METHOD"] == "POST") {
			$bill = $_POST["bill"]; //total price of exchange
			$tendered = $_POST["tendered"]; //amount of money taken
			$change = $tendered - $bill; //money owed
			
			if(is_numeric($bill) && is_numeric($tendered) && $bill <= $tendered){
				echo "<h1>Receipt</h1>";
				echo "<p>Total Bill: $" . $bill . "</p>"; //output bill
				echo "<p>Tendered: $" . $tendered . "</p>"; //output tendered
				echo "<p>Change: $" . $change . "</p>"; //output change
				disbursmentTable($change, $change);
			} else {
				echo "<h1>Please enter valid data.</h2>";
			}
			
		} 
				//call with disbursmentTable($change, $change);
			function disbursmentTable($change, $total) {
				echo "<h2>Disbursment</h2>";//table title
				echo "<table>"; //table start
				echo "<tr><th>Denomination</th><th>Qty</th><th>Disbursed</th></tr>";//table header
				
				$money = array( 100, 50, 20, 10, 5, 1, .25, .10, .05, .01 ); //Stores disbursment options

				for ( $x = 0; $x < count($money); $x++) //cycles through $money array
				{
					$counter = 0; //Resets counter for each array element
					while ( $change >= $money[$x] ) //Makes sure that enough money remains
					{
						$change -= $money[$x];
						$counter++;
					}
					echo '<tr><td>$' . $money[$x] . "</td><td>" . $counter . "</td><td>$" . ($money[$x] * $counter) . "</td></tr>";
				}
				echo "<tr><td>Total:</td><td></td><td>$" . $total . "</td></tr>";
				echo "</table>"; //table end
			}
		?>
	</body>
</html>