<?php 
require('Initialize/initialize.php');

// make sure get id is set
if(isset($_GET['id'])){
	// make sure get id is not empty
	if($_GET['id'] === "") {
		header('Location: customers.php');
	} 

	//initialize id
	$id = $_GET['id'];

	// make sure get id is a number
	$validateNumber = new numberValidate;
	if(!$validateNumber->isValid($id)) {
		header('Location: customers.php');
		exit();	
	}

	// call update method
	$customer = Customer::getCustomerByID($id);
	
	// make sure customer returned has value
	if($customer == NULL){
		header('Location: customers.php');
		exit();
	}

	// setup variables for template
	$first_name = $customer['first_name'];
	$last_name = $customer['last_name'];
	$email = $customer['email'];
	$id = $customer['id'];
	$selected1 = "";
	$selected2 = "";
	if($customer['gender'] === 'male'){
		$selected1 = 'selected';
	} else {
		$selected2 = 'selected';
	}


	// Set up template for viewing 
	$template = "
	<form method=\"POST\" action=\"update_customer.php?id=$id\">
		<label>First Name</label>
		<input type=\"text\" name=\"first_name\" value=\"$first_name\">
		<label>Last Name</label>
		<input type=\"text\" name=\"last_name\" value=\"$last_name\">
		<label>Email Name</label>
		<input type=\"email\" name=\"email\" value=\"$email\">
		<select name=\"gender\">
			<option value=\"male\" $selected1>Male</option>
			<option value=\"female\" $selected2>Female</option>
		</select>
		<button>Update</button>
	</form>";
} else  {
	// This will initialize template for new customer
	$template = '
	<form method="POST" action="new_customer.php">
		<label>First Name</label>
		<input type="text" name="first_name" value="">
		<label>Last Name</label>
		<input type="text" name="last_name" value="">
		<label>Email Name</label>
		<input type="email" name="email" value="">
		<select name="gender">
			<option value="male">Male</option>
			<option value="female">Female</option>
		</select>
		<button>ADD</button>
	</form>';
}

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