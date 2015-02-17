<?php
// Initialize Code
require('Initialize/initialize.php');

// Create new invoice detail
new Invoice($_GET['id'], $_POST['item_id'], $_POST['quantity']);