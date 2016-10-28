<?php


define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "ikarus");
define('DB_NAME', "day23");
$dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM keywords, rel_blog_post_keyword WHERE keyword = 'to' AND id = keyword_id ORDER BY count DESC";
$result = mysqli_query($dbConnection, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $res[] = $row['blog_post_id'];
    }
} else return false;

echo '<br>';
print_r($res);
echo '<br>';


?>