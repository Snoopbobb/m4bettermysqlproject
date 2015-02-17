<?php
class Item {
	private $name;
	private $price;

	/*********************************************************
		Constructor method to create new Item
	*********************************************************/
	public function __construct($name, $price) {
		$this->name = $name;
		$this->price = $price;

		$sql = "
		INSERT INTO item (
			name, price
		) VALUES (
			:name, :price
		)
		";

		$sql_values = [
			':name' => $_POST['name'],
			':price' => $_POST['price'],
		];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $sql_values);

		// Redirect
		header('Location: items.php?id=' . DB::lastInsertId());
		exit();
	}

	/*********************************************************
		method to return All Items as a template
	*********************************************************/
	public function getAllItems(){
		$sql = "
		SELECT *
		FROM item
		";

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement);

		// Get all the results of the statement into an array
		$results = $statement->fetchAll();

		// Loop array to get each row
		$template = '';
		foreach ($results as $heading => $row) {
			$template .=
					'<tr>
						<td>' . $row['name']  . '</td>
						<td>' . $row['price'] . '</td>
						<td>' . '<a href="edit_item.php?id=' . $row['id'] . '">Edit</a></td>
						<td>' . '<a href="delete_item.php?id=' . $row['id'] . '">Remove</a></td>
					</tr>';
		}
	return $template;
}

	/*********************************************************
			Method to update Items and return template
	*********************************************************/
	public function update(){
		if(isset($_GET['id'])){
			if($_GET['id'] === "") {
				header('Location: customers.php');
			}
			$sql = "
				SELECT *
				FROM item
				WHERE id = :id
				";
			$prepare_values = [
				':id' => $_GET['id']
				];
			// Make a PDO statement
			$statement = DB::prepare($sql);

			// Execute
			DB::execute($statement, $prepare_values);

			// Get all the results of the statement into an array
			$results = $statement->fetchAll();

			// Get the first result as a row
			$row = $results[0];
			$item_name = $row['name'];
			$price = $row['price'];
			$id = $row['id'];
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
		return $template;
	}

	/*********************************************************
		Method to return drop down options from Items table
	*********************************************************/
	public function getItemOptions(){
		// Loop through items to populate drop down
		$sql2 = "
			SELECT * FROM item
			";
		$prepare_values2 = [
			':id' => $_GET['id']
			];

		// Make a PDO statement
		$statement2 = DB::prepare($sql2);

		// Execute
		DB::execute($statement2);

		// Get all the results of the statement into an array
		$results2 = $statement2->fetchAll();
		foreach ($results2 as $heading2 => $row2) {
			$item .= '<option value="' . $row2['id'] . '">' . $row2['name'] . '</option>';
		}
		return $item;
	}

	/*********************************************************
				Method to delete Items by ID
	*********************************************************/
	public function deleteByID($id) {
		$sql = "
			DELETE
			FROM item
			WHERE id = $id 
			";

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement);

		header("Location: items.php");
		exit();
	}
} 