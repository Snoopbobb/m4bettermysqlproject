<?php 
// Initialize Code
require('Initialize/initialize.php');

// call deleteByID method
Item::deleteByID($_GET['id']);