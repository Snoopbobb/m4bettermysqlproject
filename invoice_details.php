<?php 
// Initialize files
require('Initialize/initialize.php');

//initialize id
$id = $_GET['id'];

//call method to retrieve customer name
$customer = Customer::getCustomerNameByID($id);

// Call method to retrieve invoice details
$template = Invoice::getInvoiceDetails($id); 

// call method to retrieve sum
$sum = Invoice::getTotal($id);

// call method to populate dropdown menu
$item = Item::getItemOptions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoice <?php echo $id; ?></title>
</head>
<body>
	<a href="/">Home</a>
	<h1>Invoice: <?php echo $id . " Customer: " . ucwords($customer); ?></h1>
	<table border="1">
		<tr>
			<th>Quantity</th>
			<th>Name</th>
			<th>Price</th>
			<th>Sub-Total</th>
		</tr>
			<?php echo $template; ?>
		<tr>
			<td></td>
			<td></td>
			<th>Total</th>
			<td>$<?php echo number_format($sum, 2); ?></td>
		</tr>
	</table>
	<form action="new_invoice.php?id=<?php echo $id; ?>" method="POST">
		<label>QTY</label>
		<input type="text" name="quantity" value="">
		<label>Item</label>
		<select name="item_id">
			<?php echo $item; ?>
		</select>
		<button>Add</button>
	</form>
	<a href="invoices.php">Back To Invoices</a>
</body>
</html>