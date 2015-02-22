<?php 
class Customer {

	public $id;
	public $first_name;
	public $last_name;
	public $email;
	public $gender;
	public $customer_since;

	/***************************************************
		Constructor method to create new customer
	***************************************************/
	public function __construct($id, $first_name, $last_name, $email, $gender, $customer_since) {
		$this->id = $id;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->email = $email;
		$this->gender = $gender;
		$this->customer_since = $customer_since;
	}

	public static function create($first_name, $last_name, $email, $gender){
		// Insert new customer data
		$sql = "
			INSERT INTO customer (
				first_name, last_name, email, gender, customer_since
			) VALUES (
				:first_name, :last_name, :email, :gender, CURDATE()
			)
			";

		$sql_values = [
			':first_name' => $first_name,
			':last_name' => $last_name,
			':email' => $email,
			':gender' => $gender,
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
	}

	/***************************************************
			Method to retrieve all customers
	****************************************************/
	public static function getCustomers(){
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

		$customers = [];
		foreach($results as $row) {
			$customers[]= new Customer($row['id'], $row['first_name'], $row['last_name'], $row['email'], $row['gender'], $row['customer_since']);
		}
		return $customers;
	}

	/***************************************************
		Method to retrieve customer name by ID
	***************************************************/
	public static function getCustomerNameByID($id){
		$sql = "
			SELECT CONCAT(c.first_name, ' ', c.last_name) AS customer_name
			FROM customer AS c
			WHERE id = :id
			";

		$sql_values = [
			':id' => $id
		];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $sql_values);

		// Get all the results of the statement into an array
		$results = $statement->fetch();

		return $results;
	}

	/****************************************************************
					Method to get customer by id
	*****************************************************************/
	public static function getCustomerByID($id){
		// Initialize SQL statement to edit individual customer
		$sql = "
			SELECT *
			FROM customer
			WHERE id = :id
			";

		$sql_values = [
			':id' => $id
			];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $sql_values);

		// Get all the results of the statement into an array
		$results = $statement->fetch();
		return $results;
	}

	/***************************************************
			Method to update customer by ID
	***************************************************/
	public function updateCustomer($first_name, $last_name, $email, $gender, $id){
	
		$sql = "
			UPDATE customer
			SET first_name = :first_name, 
				last_name = :last_name, 
				email = :email, 
				gender = :gender
			WHERE id = :id
			";

		$sql_values = [
			':first_name' => $first_name,
			':last_name' => $last_name,
			':email' => $email,
			':gender' => $gender,
			':id' => $id
		];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $sql_values);
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