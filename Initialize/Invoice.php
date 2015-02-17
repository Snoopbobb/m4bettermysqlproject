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

		// Redirect
		header('Location: invoice_details.php?id=' . $id);
		exit();
	}


	/*********************************************************
			Method to retrieve Invoice Item details
	*********************************************************/
	public function getInvoiceDetails($id){
		$sql = "
			SELECT quantity, i.name, price, (price * quantity) AS subtotal, t.id AS invoice_item_id
			FROM invoice_item AS t, invoice AS v, item AS i
			WHERE v.id = t.invoice_id
			AND i.id = t.item_id
			AND v.id = $id
			";

		$prepare_values = [
			':id' => $id
			];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement);

		// Get all the results of the statement into an array
		$results = $statement->fetchAll();

		// Loop array to get each row
		$total = [];
		$template = '';
		foreach ($results as $heading => $row) {
			$invoice_item_id = $row['invoice_item_id'];
			$template .=
					'<tr>
						<td>' . $row['quantity']  . '</td>
						<td>' . $row['name']  . '</td>
						<td>' . $row['price']  . '</td>
						<td>' . $row['subtotal'] . '</td>
						<td>' . '<a href="delete_invoice.php?id=' . $invoice_item_id . '">Remove</a></td>
					</tr>';
		}
		return $template;
	}

	/***************************************************
				Method to return all Invoices
	***************************************************/
	public function getAllInvoices(){
		$sql = "
			SELECT v.id, CONCAT(first_name, ' ', last_name) AS name, (quantity * price) AS total
			FROM customer AS c, invoice AS v, invoice_item AS t, item as i 
			WHERE c.id = v.customer_id
			AND v.id = t.invoice_id
			AND i.id = t.item_id
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
						<td>' . $row['id']  . '</td>
						<td>' . $row['name']  . '</td>
						<td>' . $row['total'] . '</td>
						<td>' . '<a href="invoice_details.php?id=' . $row['id'] . '">Details</a></td>
					</tr>';
		}
		return $template;
	}

	/***************************************************
			Method to delete Invoice Items By Id
	***************************************************/
	public function deleteByID($id){
		// Get invoice id for redirect
		$sql2 = "
			SELECT invoice_id
			FROM invoice_item
			WHERE id = $id 
			";

		// Make a PDO statement
		$statement2 = DB::prepare($sql2);

		// Execute
		DB::execute($statement2);

		// Get all the results of the statement into an array
		$results = $statement2->fetchAll();
		foreach ($results as $row) {
			$invoice_detail_id = $row['invoice_id'];
		}
		
		// delete invoice item detail
		$sql = "
			DELETE 
			FROM invoice_item
			WHERE id = $id 
			";

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement);

		 // Redirect to invoice details page
		header("Location: invoice_details.php?id=" . $invoice_detail_id);
		exit();
	}

	/***************************************************
		Method to find total of item details by id
	***************************************************/
	public function getTotal($id){
		$total[] = 0;
		$sql = "
			SELECT (price * quantity) AS subtotal
			FROM invoice_item AS t, invoice AS v, item AS i
			WHERE v.id = t.invoice_id
			AND i.id = t.item_id
			AND v.id = $id
			";

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement);

		// Get all the results of the statement into an array
		$results = $statement->fetchAll();
		foreach ($results as $row){
			$total[] .= $row['subtotal'];
		}
		$sum = array_sum($total);
		return $sum;
	}
}