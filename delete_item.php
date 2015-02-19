<?php 
// Initialize Code
require('Initialize/initialize.php');

if (isset($_GET['id'])) {
	// call deleteByID method
	Item::deleteByID($_GET['id']);
} else {
	header('Location: items.php');
}