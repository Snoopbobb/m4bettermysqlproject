<?php 
// Initialize Code
require('Initialize/initialize.php');

// Call Customer class and return template
$template = Customer::getAll();

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

