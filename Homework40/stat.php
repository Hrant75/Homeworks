<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>country ip stat</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php

include_once 'db.php';

$sql = "SELECT ip, country, time FROM countryip_stat ORDER BY id DESC LIMIT 10";
$statement = $conn->prepare($sql);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$result = $statement->fetchAll();

echo '';
echo '<div class="container"><h2>last 10 visits</h2><br><table  class="table"><thead>
      <tr>
        <th>ip</th>
        <th>country</th>
        <th>time</th>
      </tr>
    </thead><tbody>';
foreach ($result as $value){
    echo "<tr>
        <td>".$value['ip']."</td>
        <td>".$value['country']."</td>
        <td>".$value['time']."</td>
      </tr>";
}
echo '</tbody></table></div>';
echo '<h3 style="position: absolute; bottom:0; right: 10px"><a href="index.php">Home page</a></h3>';