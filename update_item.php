<?php

// Initialize Code
require('Initialize/initialize.php');

$id = $_GET['id'];

$sql = "
	UPDATE item
	SET name = :name, 
		price = :price 
	WHERE id = :id
	";

$sql_values = [
	':name' => $_POST['name'],
	':price' => $_POST['price'],
	':id' => $_GET['id']
];

// Make a PDO statement
$statement = DB::prepare($sql);

// // Bind Parameters individually instead of using sql_values array
// $statement->bindValue(':first_name', $_POST['first_name']);
// $statement->bindValue(':last_name', $_POST['last_name']);
// $statement->bindValue(':email', $_POST['email']);

// Execute
DB::execute($statement, $sql_values);

// Redirect
header("Location: edit_item.php?id=$id");
exit();