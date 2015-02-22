<?php 
// Initialize files
require('Initialize/initialize.php');

//initialize id
$id = $_GET['id'];

//call method to retrieve customer name
$customerName = Customer::getCustomerNameByID($id);

// convert customer from array to string
$customer = $customerName['customer_name'];

// Call method to retrieve invoice details
$invoiceDetails = Invoice::getInvoiceDetails($id);

// Loop over invoice details and set up template
$total = [];
$template = '';
foreach ($invoiceDetails as $row) {
	$invoice_id = $row['invoice_id'];
	$item_id = $row['item_id'];
	$template .=
		'<tr>
			<td>' . $row['quantity']  . '</td>
			<td>' . $row['name']  . '</td>
			<td>' . $row['price']  . '</td>
			<td>' . $row['subtotal'] . '</td>
			<td>' . '<a href="delete_invoice.php?invoice_id=' . $invoice_id . '&item_id=' . $item_id . '">Remove</a></td>
		</tr>';
}

// call method to retrieve total
$getTotalResults = Invoice::getTotal($id);

$subTotal = [];
// Take getTotal results and pull out invoice id and subtotal
foreach ($getTotalResults as $row) {
	$subTotal[] .= $row['subtotal'];
}
// Find sum of invoice detail items
$sum = array_sum($subTotal);

// get all items and create dropdown list
$getItems = Item::getItems();

$options = "";
		foreach ($getItems as $row) {
			$options .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
		}
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
			<?php echo $options; ?>
		</select>
		<button>Add</button>
	</form>
	<a href="invoices.php">Back To Invoices</a>
</body>
</html>