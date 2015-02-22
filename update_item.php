<?php

// Initialize Code
require('Initialize/initialize.php');

// Validate Price
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['price']) && $_POST['price']) {
		$price = $_POST['price'];
		$validateNumber = new numberValidate;
		if(!$validateNumber->isValid($price)) {
			$message = "'$price' is not a valid number. Only numbers are allowed.";
			echo "<h3 style=\"color:red;\">$message</h3>";
			exit();	
		}
	} else {
		$message = "Price must not be empty.";
		echo "<h3 style=\"color:red;\">$message</h3>";
		exit();
	}
	// call method to update item
	Item::updateItem($_POST['name'], $_POST['price'], $_GET['id']);

	// redirect to edti item page
	header('Location: items.php');
} 