<?php 
// Initialize Code
require('Initialize/initialize.php');

if (isset($_GET['invoice_id'])){
	// Call deleteByID method from Invoice
	$invoice_id = Invoice::deleteByID($_GET['invoice_id'], $_GET['item_id']);
} else {
	header('Location: invoices.php');
}

// Redirect to invoice details page
header("Location: invoice_details.php?id=" . $invoice_id['invoice_id']);
exit();