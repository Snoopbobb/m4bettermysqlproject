<?php 
// Initialize Code
require('Initialize/initialize.php');

if (isset($_GET['id'])){
	// Call deleteByID method from Invoice
	Invoice::deleteByID($_GET['id']);
} else {
	header('Location: invoices.php');
}