<?php

require_once '../database/DB.php';

$db = new DB(); 

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($db->getConnection()) {
    echo 'Database connection successful!';
} else {
    echo 'Database connection failed!';
}
?>
