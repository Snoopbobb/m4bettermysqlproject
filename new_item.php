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

	// make sure item isn't empty
	if(empty($_POST['name'])){
		$message = "Item must not be empty.";
		echo "<h3 style=\"color:red;\">$message</h3>";
		exit();
	}
	
	// put it in database
	Item::create($_POST['name'], $_POST['price']);
}
header('Location: items.php');
exit();