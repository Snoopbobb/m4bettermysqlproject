<?php 
//  Initialize files
require('Initialize/initialize.php');

// call update method and return template
$template = Item::update();
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