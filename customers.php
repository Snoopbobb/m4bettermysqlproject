<?php 
// Initialize Code
require('Initialize/initialize.php');

// Call Customer class and return customers
$customers = Customer::getCustomers();

// Loop array to get each row
$template = '';
foreach ($customers as $customer) {
	$template .=
			'<tr>
				<td>' . ucfirst($customer->first_name)  . '</td>
				<td>' . ucfirst($customer->last_name) . '</td>
				<td>' . $customer->email . '</td>
				<td>' . '<a href="invoice_details.php?id=' . $customer->id . '">New Invoice</a></td>
				<td>' . '<a href="edit_customer.php?id=' . $customer->id . '">Edit</a></td>
				<td>' . '<a href="delete_customer.php?id=' . $customer->id . '">Remove</a></td>
			</tr>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Customers</title>
</head>
<body>
	<a href="/">Home</a>
	<h1>Customers</h1>
	<table border="1">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
		</tr>
			<?php echo $template; ?>
	</table>
	<a href="edit_customer.php">Add Customer</a>
</body>
</html>

