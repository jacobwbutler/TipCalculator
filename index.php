<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Tip Calculator</title>
	<link rel="stylesheet" href="stylesheet.css">
</head>
<body>
	<?php
		// Setup empty variables
		$bill_subtotal = $bill_subtotal_error = "";
		$gratuity = $gratuity_error = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["bill_subtotal"]) || $_POST["bill_subtotal"] <= 0) {
				$bill_subtotal_error = "* Bill Subtotal is required";
			} else {
				$bill_subtotal = $_POST["bill_subtotal"];
			}

			if (empty($_POST["gratuity"]) && empty($_POST["custom_gratuity"])) {
				$gratuity_error = "* Gratuity is required";
			} else if (!empty($_POST["custom_gratuity"])) {
				$gratuity = $_POST["custom_gratuity_input"];
			} else {
				$gratuity = $_POST["gratuity"];
			}
		}
	?>

	<h1>Tip Calculator<h1>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		Bill Subtotal: $<input type="number" step="0.01" name="bill_subtotal" value="<?php echo $_POST["bill_subtotal"];?>">
		<span> <?php echo $bill_subtotal_error;?> </span>
		<br></br>
		Tip Percentage:
		<input type="radio" name="gratuity" <?php if (isset($gratuity) && $gratuity==0.10) echo "checked"; ?> value="0.10">10%
		<input type="radio" name="gratuity" <?php if (isset($gratuity) && $gratuity==0.15) echo "checked"; ?> value="0.15">15%
		<input type="radio" name="gratuity" <?php if (isset($gratuity) && $gratuity==0.20) echo "checked"; ?> value="0.20">20%
		<input type="radio" name="custom_gratuity" value="<?php echo $_POST["custom_gratuity"];?>">Custom: <input type="number" step="0.01" name="custom_gratuity_input"/>%
		<span> <?php echo $gratuity_error;?> </span>
		<br><br>
		<input type="submit">
	</form>

	<?php 
		if ($_SERVER["REQUEST_METHOD"] == "POST" 
				&& $bill_subtotal_error == ""
				&& $gratuity_error == "") {

			$tip = $bill_subtotal * $gratuity;
			$total = $bill_subtotal + $tip;
			echo "<br> Tip: $" . $tip . "<br>";
			echo "Total: $" . $total . "<br>";
		}
	?>

</body>
</html>

</html>