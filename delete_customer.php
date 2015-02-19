<?php 
// Initialize Code
require('Initialize/initialize.php');

If(isset($_GET['id'])){
	// Call method delete by ID
	Customer::deleteByID($_GET['id']);

	// Redirect to customers page
	header("Location: customers.php");
	exit();
	
} else {
	// Redirect to customers page
	header("Location: customers.php");
	exit();
}
