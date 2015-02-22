<?php
class Item {
	public $name;
	public $price;
	public $id;

	/*********************************************************
		Constructor method to create new Item
	*********************************************************/
	public function __construct($id, $name, $price) {
		$this->id = $id;
		$this->name = $name;
		$this->price = $price;
	}


	public static function create($name, $price) {
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

		return new Item(DB::lastInsertID(), $name, $price);
	}

	/*********************************************************
					method to get all items
	*********************************************************/
	public static function getItems(){
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

		return $results;
	}

	/*********************************************************
					Method to get item
	*********************************************************/
	public static function getItem($id){
		$sql = "
			SELECT *
			FROM item
			WHERE id = :id
			";
		$prepare_values = [
			':id' => $id
			];
		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $prepare_values);

		// Get all the results of the statement into an array
		$result = $statement->fetch();

		return new Item($id, $result['name'], $result['price']);
	}

	/*********************************************************
					Method to update Items 
	*********************************************************/	
	public static function updateItem($id){
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

	 	// Execute
	 	DB::execute($statement, $sql_values);
		
	}

	/*********************************************************
				Method to delete Items by ID
	*********************************************************/
	public static function deleteByID($id) {

		$sql = "
			DELETE
			FROM item
			WHERE id = :id 
			";

		$sql_values = [
	 		':id' => $id
			];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $sql_values);
	}
} 