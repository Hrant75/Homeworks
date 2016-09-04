<?php

define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "ikarus");
define('DB_NAME', "aca");
//$dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//if (!$dbConnection) {
//    die("Connection failed: " . mysqli_connect_error());
//}

$conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$table_name = 'countryip';
$country_column_name = 'country';
$ip_start_column = 'n1';
$ip_end_column = 'n2';