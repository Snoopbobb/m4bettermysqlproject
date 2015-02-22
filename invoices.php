<?php 
// Initialize Code
require('Initialize/initialize.php');

// Call method to retrieve all invoices
$results = Invoice::getAllInvoices(); 

// Loop array to get each row
$template = '';
$total = "";
foreach ($results as $row) {
	$template .=
		'<tr>
			<td>' . $row['id']  . '</td>
			<td>' . ucwords($row['name'])  . '</td>
			<td>' . $row['subtotal'] . '</td>
			<td>' . '<a href="invoice_details.php?id=' . $row['id'] . '">Details</a></td>
		</tr>';
	$total += $row['subtotal'];
	}
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
		<tr>
			<td></td>
			<th>Total</th>
			<td><?php echo "$" . number_format($total, 2); ?></td>
		</tr>
	</table>
</body>
</html>

