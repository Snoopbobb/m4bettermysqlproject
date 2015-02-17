<?php

// Initialize Code
require('Initialize/initialize.php');

$id = $_GET['id'];

$sql = "
	UPDATE customer
	SET first_name = :first_name, 
		last_name = :last_name, 
		email = :email, 
		gender = :gender
	WHERE id = :id
	";

$sql_values = [
	':first_name' => $_POST['first_name'],
	':last_name' => $_POST['last_name'],
	':email' => $_POST['email'],
	':gender' => $_POST['gender'],
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
header("Location: edit_customer.php?id=$id");
exit();