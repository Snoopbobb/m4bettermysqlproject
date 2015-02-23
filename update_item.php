<?php

// Initialize Code
require('Initialize/initialize.php');

// make sure post is set
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// validate price
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
	// call method to update item
	Item::updateItem($_GET['id'], $_POST['name'], $_POST['price']);

	// redirect to items page
	header('Location: items.php');
} 
header('Location: items.php');