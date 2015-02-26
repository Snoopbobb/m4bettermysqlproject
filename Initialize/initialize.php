<?php

// Error Reporting and Display Errors
// error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
// ini_set('display_errors', TRUE);

// Database Credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'posbetter');



// Include validation files
require_once('Initialize/Validate.php');
require_once('Initialize/Email_Validate.php');
require_once('Initialize/Number_Validate.php');

// Include Common Files
require_once('Initialize/DB.php');
require_once('Initialize/Customer.php');
require_once('Initialize/Item.php');
require_once('Initialize/Invoice.php');