<?php 
class Customer extends Manager {

	private $first_name;
	private $last_name;
	private $email;
	private $gender;
	private $customer_since;

	/***************************************************
		Constructor method to create new customer
	***************************************************/
	public function __construct($first_name, $last_name, $email, $gender) {
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->email = $email;
		$this->gender = $gender;

		// Insert new customer data
		$sql = "
			INSERT INTO customer (
				first_name, last_name, email, gender, customer_since
			) VALUES (
				:first_name, :last_name, :email, :gender, CURDATE()
			)
			";

		$sql_values = [
			':first_name' => $this->first_name,
			':last_name' => $this->last_name,
			':email' => $this->email,
			':gender' => $this->gender,
		];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $sql_values);

		$customer_id = DB::lastInsertId();

		// Insert new invoice data
		$sql2 = "
			INSERT INTO invoice (
				customer_id, created_at
			) VALUES (
				:customer_id, CURDATE()
			)
		";

		$sql_values2 = [
			':customer_id' => $customer_id
		];

		// Make a PDO statement
		$statement2 = DB::prepare($sql2);

		// Execute
		DB::execute($statement2, $sql_values2);
		// Redirect
		header('Location: edit_customer.php?id=' . $customer_id);
		exit();
	
	}

	/***************************************************
			Method to retrieve all customers
	***************************************************/
	public function getAll(){
		$sql = "
			SELECT *
			FROM customer
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
						<td>' . ucfirst($row['first_name'])  . '</td>
						<td>' . ucfirst($row['last_name']) . '</td>
						<td>' . $row['email'] . '</td>
						<td>' . '<a href="invoice_details.php?id=' . $row['id'] . '">New Invoice</a></td>
						<td>' . '<a href="edit_customer.php?id=' . $row['id'] . '">Edit</a></td>
						<td>' . '<a href="delete_customer.php?id=' . $row['id'] . '">Remove</a></td>
					</tr>';
		}
		return $template;
	}

	/***************************************************
		Method to retrieve customer name by ID
	***************************************************/
	public function getCustomerNameByID($id){
		$sql = "
			SELECT CONCAT(c.first_name, ' ', c.last_name) AS customer_name
			FROM customer AS c
			WHERE id = $id
			";

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement);

		// Get all the results of the statement into an array
		$results = $statement->fetchAll();

		return $results[0]['customer_name'];
	}

	/****************************************************************
		Method to update customer also creates form for new customer
	*****************************************************************/
	public function update(){
		// Initialize SQL statement and template for viewing and editing individual customer
		if(isset($_GET['id'])){
			if($_GET['id'] === "") {
				header('Location: customers.php');
			} 
			$sql = "
				SELECT *
				FROM customer
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
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$email = $row['email'];
			$id = $row['id'];

			// Set up template for viewing 
			$template = "
			$message
			<form method=\"POST\" action=\"update_customer.php?id=$id\">
				<label>First Name</label>
				<input type=\"text\" name=\"first_name\" value=\"$first_name\">
				<label>Last Name</label>
				<input type=\"text\" name=\"last_name\" value=\"$last_name\">
				<label>Email Name</label>
				<input type=\"email\" name=\"email\" value=\"$email\">
				<select name=\"gender\">
					<option value=\"male\">Male</option>
					<option value=\"female\">Female</option>
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
		return $template;
	}

	/***************************************************
			Method to delete customer by ID
	***************************************************/
	public function deleteByID($id){ 
		$sql = "
			DELETE
			FROM customer
			WHERE id =$id";

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement);
	}
}