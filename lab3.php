<!DOCTYPE html>
<html>
	<head>
		<title>Calc | Lab3</title>
		<link href="css.css" type="text/css" rel="stylesheet">
	</head>
		<body>
		<?php
			if($_SERVER["REQUEST_METHOD"] == "GET")
			{
			?>
				<form method="POST" action="lab3.php">
					<h1>Sales Calculator</h1>
					<table>
					<tr><td>Invoice Item 1: <input type="text" name="invoiceItem1"></td>
					<td>Price: <input type="text" name="invoiceItem1Price"></td></tr>
					<tr><td>Invoice Item 2: <input type="text" name="invoiceItem2"></td>
					<td>Price: <input type="text" name="invoiceItem2Price"></td></tr>
					<tr><td>Invoice Item 3: <input type="text" name="invoiceItem3"></td>
					<td>Price: <input type="text" name="invoiceItem3Price"></td></tr>
					<tr><td>Invoice Item 4: <input type="text" name="invoiceItem4"></td>
					<td>Price: <input type="text" name="invoiceItem4Price"></td></tr>
					<tr><td><input type="checkbox" name="applyTax" value="yes">Include Tax?</td>
					<tr><td><input type="submit" value="Submit" class="button"></td></tr>
					</table>
				</form>
		
			<?php
			} else if($_SERVER["REQUEST_METHOD"] == "POST")
			{
				echo "<h1>Results</h1>";
				
				echo "<table>";
				echo "<tr><td>Invoice Item 1: " . $_POST["invoiceItem1"] . "</td><td>Price: $" . $_POST["invoiceItem1Price"] . "</td></tr>";
				echo "<tr><td>Invoice Item 2: " . $_POST["invoiceItem2"] . "</td><td>Price: $" . $_POST["invoiceItem2Price"] . "</td></tr>";
				echo "<tr><td>Invoice Item 3: " . $_POST["invoiceItem3"] . "</td><td>Price: $" . $_POST["invoiceItem3Price"] . "</td></tr>";
				echo "<tr><td>Invoice Item 4: " . $_POST["invoiceItem4"] . "</td><td>Price: $" . $_POST["invoiceItem4Price"] . "</td></tr>";
				echo "</table>";
				
				echo "<table class=\"important\">";
				
				//Subtotal
				$subtotal = $_POST["invoiceItem1Price"] + $_POST["invoiceItem2Price"] + $_POST["invoiceItem3Price"] + $_POST["invoiceItem4Price"] . "<br>";
				echo "<tr><td>Subtotal: $" . $subtotal ."</td></tr>";
				
				$tax = 0;
				if (isset($_POST['applyTax'])){
					//Tax
					$tax = $subtotal * .07;
					echo "<tr><td>Tax: $" . $tax . "</td></tr>";
				} else {
					echo "<tr><td>Tax: $" . $tax . "</td></tr>";
				}
				//Total
				$total = $subtotal + $tax;
				echo "<tr><td class=\"total\">Total: $" . $total . "</td></tr>"; 
			}
		?>	
		</body>
</html>