<?php 
//  Initialize files
require('Initialize/initialize.php');

	if(isset($_GET['id'])){
		if($_GET['id'] === "") {
			header('Location: items.php');
		}
		// call update method and return template
		$item = Item::getItem($_GET['id']);
		// set variables for template
		$item_name = $item->name;
		$price = $item->price;
		$id = $item->id;
		// Initialize template for updating item
		$template = "
		<form method=\"POST\" action=\"update_item.php?id=$id\">
			<label>Item</label>
			<input type=\"text\" name=\"name\" value=\"$item_name\">
			<label>Price</label>
			<input type=\"text\" name=\"price\" value=\"$price\">
			<button>Update</button>
		</form>";
	} else {
		// Initialize template for adding item
		$template = '
		<form method="POST" action="new_item.php">
			<label>Item</label>
			<input type="text" name="name" value="">
			<label>Price</label>
			<input type="text" name="price" value="">
			<button>Add</button>
		</form>';
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Item</title>
</head>
<body>
	<a href="/">Home</a>
	<?php echo $template; ?>
	<a href="/items.php">Back To Items</a>
	<a href="items.php">Cancel</a>
</body>
</html>