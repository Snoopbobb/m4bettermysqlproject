<?php 
// Initialize Code
require('Initialize/initialize.php');

// Loop array to get each row
$items = Item::getItems();

// Call method to get all Items
$template = "";
foreach ($items as $item) {
	$template .=
			'<tr>
				<td>' . $item['name']  . '</td>
				<td>' . $item['price'] . '</td>
				<td>' . '<a href="edit_item.php?id=' . $item['id'] . '">Edit</a></td>
				<td>' . '<a href="delete_item.php?id=' . $item['id'] . '">Remove</a></td>
			</tr>';
}


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

