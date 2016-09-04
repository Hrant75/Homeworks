<?php


define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "ikarus");
define('DB_NAME', "aca");
$dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

$row = 1;
if (($handle = fopen("GeoIPCountryWhois.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 150, ",")) !== FALSE) {
        $sql = "INSERT INTO countryip (ip1, ip2, n1, n2, iso, country_name) VALUES ('".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."')";
        $result = mysqli_query($dbConnection, $sql);
        echo "<p> line $row: <br /></p>\n";
        $row++;
    }
    fclose($handle);
}

