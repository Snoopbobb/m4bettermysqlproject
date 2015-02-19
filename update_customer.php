<?php
// Validate Email
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['email']) && $_POST['email']) {
		$email = $_POST['email'];
		$emailValidate = new emailValidate;
		if(!$emailValidate->isValid($email)) {
			$message = "'$email' is not a valid email address. Please enter a valid email address.";
			$email = '';
			echo "<h3 style=\"color: red;\">$message</h3>";
			exit();
		} 
	} else {
		$message = "Email must not be empty.";
		echo "<h3 style=\"color: red;\">$message</h3>";
		exit();
	}
	// Initialize Code
	require('Initialize/initialize.php');

	// call method to update customer
	Customer::updateCustomer($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['gender'], $_GET['id']);
}