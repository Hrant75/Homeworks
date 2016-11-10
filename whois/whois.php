<?php
$domain = NULL;
if(isset($_GET['domain'])){
    $domain = $_GET['domain'];
}

define ('ABC', "abcdefghijklmnopqrstuvwxyz0123456789");
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "datapass");
define('DB_NAME', "aca");

function QueryWhoisServer($whoisserver, $domain) {
    $port = 43;
    $timeout = 10;
    $fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout) or die("Socket Error " . $errno . " - " . $errstr);
    if($whoisserver == "whois.verisign-grs.com") $domain = "domain ".$domain; // whois.verisign-grs.com needs to be proceeded by the keyword "domain ", otherwise it will return any result containing the searched string.
    fputs($fp, $domain . "\r\n");
    $out = "";
    while(!feof($fp)){
        $out .= fgets($fp);
    }
    fclose($fp);

    $res = "";
    if((strpos(strtolower($out), "error") === FALSE) && (strpos(strtolower($out), "not allocated") === FALSE)) {
        $rows = explode("\n", $out);
        foreach($rows as $row) {
            $row = trim($row);
            if(($row != '') && ($row{0} != '#') && ($row{0} != '%')) {
                $res .= $row."\n";
            }
        }
    }
    return $res;
}


?>
<html>
<head>
    <title>Whois Lookup Script</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form action="<?=$_SERVER['PHP_SELF'];?>">
    <p><b><label for="domain">Domain/IP Address:</label></b> <input type="text" name="domain" id="domain" value="<?=$domain;?>"> <input type="submit" value="Lookup"></p>
</form>
<?php

if($domain) {
    $result = QueryWhoisServer("whois.amnic.net", $domain.".am");
    if ($result == "No match") {
        echo "No match";
    } else {
        echo "<pre><br>" . $result . "<br></pre><br>";
    }
}

$db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
$db->exec('TRUNCATE TABLE whois;');
$stmt = $db->prepare("INSERT INTO whois (`freedomain`) VALUES(?)");

function letters($length, $prefix='') {
    global $stmt;
    if ($length == 0) return;
    foreach(str_split(ABC) as $letter) {
        $word = $prefix . $letter;

//        $result = QueryWhoisServer("whois.amnic.net", $word.".am");
//        if ($result == "No match") {
            $stmt->bindValue(1, $word, PDO::PARAM_STR);
            $stmt->execute();
//        }
        letters($length-1, $prefix . $letter);
    }
}


try {
    $db->beginTransaction();
    letters(2);
    $db->commit();
} catch(PDOException $e) {
    $db->rollBack();
}

?>
</body>
</html>
