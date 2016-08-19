<?php
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "ikarus");
define('DB_NAME', "aca");
$dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}