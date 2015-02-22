<?php 
// Initialize Code
require('Initialize/initialize.php');

if (isset($_GET['id'])) {
	// call deleteByID method
	Item::deleteByID($_GET['id']);
	header("Location: items.php");
	exit();
} else {
	header('Location: items.php');
	exit();
}