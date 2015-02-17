<?php 
// Initialize Code
require('Initialize/initialize.php');

// Call method to retrieve all invoices
$template = Invoice::getAllInvoices(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoices</title>
</head>
<body>
	<a href="/">Home</a>
	<h1>Invoices</h1>
	<table border="1">
		<tr>
			<th>Invoice</th>
			<th>Name</th>
			<th>Sub-Total</th>
		</tr>
			<?php echo $template; ?>
	</table>
</body>
</html>

