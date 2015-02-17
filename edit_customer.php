<?php 
require('Initialize/initialize.php');

// call update method
$template = Customer::update();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Customer</title>
</head>
<body>
	<a href="/">Home</a>
	<?php echo $template; ?>
	<a href="customers.php">Back To Customers</a>
	<a href="customers.php">Cancel</a>
</body>
</html>