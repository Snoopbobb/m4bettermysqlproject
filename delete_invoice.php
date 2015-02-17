<?php 
// Initialize Code
require('Initialize/initialize.php');

// Call deleteByID method from Invoice
Invoice::deleteByID($_GET['id']);