<?php
class Invoice {
	private $invoice_id;
	private $item_id;
	private $quantity;

	/*********************************************************
				Method to create new Invoice Item
	*********************************************************/
	public function __construct($invoice_id, $item_id, $quantity){
		$this->invoice_id = $invoice_id;
		$this->item_id = $item_id;
		$this->quantity = $quantity;

		$id = $this->invoice_id;

		$sql = "
			INSERT INTO invoice_item (
				invoice_id, item_id, quantity
			) VALUES (
				:invoice_id, :item_id, :quantity
			)
			ON DUPLICATE KEY UPDATE
			quantity = :quantity
			";

		$sql_values = [
			':invoice_id' => $this->invoice_id,
			':item_id' => $this->item_id,
			':quantity' => $this->quantity,
		];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $sql_values);
	}

	/***************************************************
		Method to return all Invoices (not details)
	***************************************************/
	public static function getAllInvoices(){
		$sql = "
			SELECT v.id, CONCAT(first_name, ' ', last_name) AS name, SUM(quantity * price) AS subtotal
			FROM customer AS c, invoice AS v, invoice_item AS t, item as i 
			WHERE c.id = v.customer_id
			AND v.id = t.invoice_id
			AND i.id = t.item_id
			Group by t.invoice_id
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
			Method to retrieve Invoice Item details
	*********************************************************/
	public static function getInvoiceDetails($id){
		$sql = "
			SELECT quantity, i.name, price, (price * quantity) AS subtotal, t.invoice_id, t.item_id
			FROM invoice_item AS t, invoice AS v, item AS i
			WHERE v.id = t.invoice_id
			AND i.id = t.item_id
			AND v.id = :id
			";

		// $sql = "
		// 	SELECT quantity, item.name, price, (price * quantity) AS subtotal
		// 	FROM item
		// 	JOIN invoice_item ON (invoice_item.item_id = item.id)
		// 	JOIN invoice ON (invoice_item.invoice_id = invoice.id)
		// 	WHERE invoice.id = invoice_item.invoice_id AND invoice_item.item_id = item.id
		// ";

		$sql_values = [
			':id' => $id
			];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $sql_values);

		// Get all the results of the statement into an array
		$results = $statement->fetchAll();
		
		return $results;
	}


	/***************************************************
			Method to delete Invoice Items By Id
	***************************************************/
	public static function deleteByID($invoice_id, $item_id){
		// Get invoice id for redirect
		$sql = "
			SELECT invoice_id
			FROM invoice_item
			WHERE invoice_id = :invoice_id 
			";

		$sql_values = [
			':invoice_id' => $invoice_id
			];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $sql_values);

		// Get all the results of the statement into an array
		$results = $statement->fetch();
		
		// delete invoice item detail
		$sql2 = "
			DELETE 
			FROM invoice_item
			WHERE (invoice_id, item_id) IN ((:invoice_id, :item_id))
			";

		$sql_values2 = [
			':invoice_id' => $invoice_id,
			':item_id' => $item_id
			];

		// Make a PDO statement
		$statement2 = DB::prepare($sql2);

		// Execute
		DB::execute($statement2, $sql_values2);

		return $results;
	}

	/***************************************************
		Method to find total of item details by id
	***************************************************/
	public static function getTotal($id){
		$sql = "
			SELECT (price * quantity) AS subtotal
			FROM invoice_item AS t, invoice AS v, item AS i
			WHERE v.id = t.invoice_id
			AND i.id = t.item_id
			AND v.id = :id
			";

		$sql_values = [
			':id' => $id
			];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $sql_values);

		// Get results
		$results = $statement->fetchAll();

		// return results
		return $results;
	}
}