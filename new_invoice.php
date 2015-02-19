<?php
// Initialize Code
require('Initialize/initialize.php');

// Validate Quantity
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['quantity']) && $_POST['quantity']) {
		$quantity = $_POST['quantity'];
		$validateNumber = new numberValidate;
		if(!$validateNumber->isValid($quantity)) {
			$message = "'$quantity' is not a valid number. Only numbers are allowed.";
			echo "<h3 style=\"color:red;\">$message</h3>";
			exit();	
		}
	} else {
		$message = "Quantity must not be empty.";
		echo "<h3 style=\"color:red;\">$message</h3>";
		exit();
	}
	// Create new invoice detail
	new Invoice($_GET['id'], $_POST['item_id'], $_POST['quantity']);
}