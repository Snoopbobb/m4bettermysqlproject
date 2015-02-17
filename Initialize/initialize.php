<?php

// Error Reporting and Display Errors
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', TRUE);

// Database Credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'posbetter');

// Include Common Files
require('Initialize/DB.php');
require('Initialize/Manager.php');
require('Initialize/Customer.php');
require('Initialize/Item.php');
require('Initialize/Invoice.php');