<?php

include_once 'db.php';


$ip =  $_SERVER['REMOTE_ADDR'];
$long = ip2long($ip);

$sql = "SELECT $country_column_name FROM $table_name WHERE $long <= $ip_end_column && $ip_start_column <= $long";
$statement = $conn->prepare($sql);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$result = $statement->fetchAll();

if(count($result)>0) {
    $country = $result[0][$country_column_name];
} else {
    $country = "N/A";
}

$sql = "INSERT INTO countryip_stat (`ip`, `country`) VALUES ('".$ip."', '".$country."')";
$statement = $conn->prepare($sql);
$statement->execute();

//http://dev.maxmind.com/minfraud/
?>
<h1 style="text-align: center; font-size: 500%; padding-top: 10%">Your ip is - <?=$ip?></h1>
<h1 style="text-align: center; font-size: 500%">Your country - <?=$country?></h1>

<h5 style="position: absolute; bottom:0">try it with <a href="https://www.geoscreenshot.com">https://www.geoscreenshot.com</a></h5>
<h4 style="position: absolute; bottom:0; right: 10px"><a href="stat.php">Website Visit Stat</a></h4>
