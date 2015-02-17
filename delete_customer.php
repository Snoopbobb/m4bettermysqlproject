<?php 
// Initialize Code
require('Initialize/initialize.php');

Customer::deleteByID($_GET['id']);

header("Location: customers.php");
exit();
