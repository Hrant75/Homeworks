<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students and Subjects</title>
    <link href="main.css" rel="stylesheet">
    <link href="bootstrap.min.css" rel="stylesheet">
<!--    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">-->
</head>
<body>

<?php
chdir(dirname(__DIR__));

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;

/** @var $client Client */
$client = new Client(["base_uri" => "https://api.github.com"]);

/** @var $response \GuzzleHttp\Psr7\Response */
$response = $client->get('/users/tigranmaestro/gists');
//$response = $client->get('/gists/7f947bb10def796fae6b7d08afe2bbfd');

$body = $response->getBody();

$content = json_decode($body->getContents());

echo "<pre>";
print_r($content);
echo "</pre>";

?>

<div class="container">
    <h2>Gist Table</h2>
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>Firstname</th>-->
<!--            <th>Lastname</th>-->
<!--            <th>Email</th>-->
<!--        </tr>-->
<!--        </thead>-->
        <?php
        foreach ($content as $item => $value) {
            echo '
                <table class="table">
                <tbody>
                <tr>
                    <td>' . $item . '</td>
                    
                    <td>';
                    myEcho($value);
            echo '</td> </tr> 
            </tbody>
        </table>';
        };
    ?>

</div>

<?php
function myEcho($undef){
    if ( is_object($undef) ) {

        echo '<ul>';
        foreach ($undef as $valueKey => $valueItem){
            if($valueKey != 'raw_url') {
                echo "<li><pre>" . $valueKey . ' => ';
                myEcho($valueItem);
                echo "</pre></li>";
            } else {
                echo 'fail enq tpum '. $valueItem;
            }
        }
        echo '</ul>';
    } elseif ( is_array($undef) ){
        echo '<ul>';
        for($i=0; $i<count($undef); $i++){
            echo "<li><pre>";
            myEcho($undef[$i]);
            echo "</pre>td</li>";
        }
        echo '</ul>';
    } else {
        echo $undef;
    }
}
?>


