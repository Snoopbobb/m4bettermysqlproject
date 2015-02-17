<?php
// Initialize Code
require('Initialize/initialize.php');

//  Create new customer
new Customer($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['gender']);