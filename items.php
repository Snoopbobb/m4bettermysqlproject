<?php 
// Initialize Code
require('Initialize/initialize.php');

// Call method to get all Items
$template = Item::getAllItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Items</title>
</head>
<body>
	<a href="/">Home</a>
	<h1>Items</h1>
	<table border="1">
		<tr>
			<th>Product Name</th>
			<th>Price</th>
		</tr>
			<?php echo $template; ?>
	</table>
	<a href="edit_item.php">Add Item</a>
</body>
</html>

