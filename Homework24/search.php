<?php


//define('DB_HOST', "localhost");
//define('DB_USER', "root");
//define('DB_PASSWORD', "ikarus");
//define('DB_NAME', "day23");
//$dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//if (!$dbConnection) {
//    die("Connection failed: " . mysqli_connect_error());
//}

$searchWord = strtolower($_GET['searchInput']);
if (strlen($searchWord) < 2){
    echo 'please input more than 1 character';
    die;
}

//                 ------ stex sksvum a search indexingi kode
//$posts = [];
//$mySqlResult = mysqli_query($dbConnection, "TRUNCATE TABLE keywords");
//$mySqlResult = mysqli_query($dbConnection, "TRUNCATE TABLE rel_blog_post_keyword;");
////
//$sql = "SELECT * FROM blog_posts";
//$result = mysqli_query($dbConnection, $sql);
//if (mysqli_num_rows($result) > 0) {
//    while($row = mysqli_fetch_assoc($result)) {
//        $posts[] = array('id' => $row['id'], 'content' => strtolower($row['title'].' '.$row['content']));
//    }
//} else return false;
//
//$totalKeywords = [];
//foreach ($posts as $post) {
//    $tmp = [];
////    $keywords = explode(' ', $post['content']);
//    $keywords = preg_split("/[\s,.:?]+/", $post['content']);
//    $keywords = array_unique($keywords);
//    foreach ($keywords as $keyword){
//        $keyword = strtolower(chop(chop(chop($keyword, '.'), ',')));
//        if($keyword != '' && strlen($keyword) > 1){
//            $tmp[] = $keyword;
//        }
//    }
//    $totalKeywords = array_merge($totalKeywords, $tmp);
//}
//$totalKeywordsUnique = array_unique($totalKeywords);
//
//$totalKeywordsArray = [];
//foreach ($totalKeywordsUnique as $totalKeyword) {
//    $sql = "INSERT INTO keywords (keyword) VALUES ('" . $totalKeyword . "')";
//    $result = mysqli_query($dbConnection, $sql);
//    $keywordId = mysqli_insert_id($dbConnection);
//    $totalKeywordsArray[$keywordId] = $totalKeyword;
//}
//
//foreach ($posts as $post) {
//    foreach ($totalKeywordsArray as $keywordId => $totalKeyword) {
//        $count = substr_count($post['content'], $totalKeyword);
//        if ($count) {
//            $sql = "INSERT INTO rel_blog_post_keyword (`blog_post_id`, `keyword_id`, `count`) VALUES (" . $post['id'] . "," . $keywordId . "," . $count . ")";
//            mysqli_query($dbConnection, $sql);
//        }
//    }
//}
//                 ------ stex verjanum a search indexingi kode


$res = [];
$sql = "SELECT * FROM keywords, rel_blog_post_keyword WHERE keyword = '".$searchWord."' AND id = keyword_id ORDER BY count DESC";
$result = mysqli_query($dbConnection, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $res[] = $row['blog_post_id'];
    }
} else return false;
?>

<h3 class="text-center">Search Result</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Date Created</th>
                <th>Title</th>
                <th>Content</th>
                <th>Author_ID</th>
                <th>Base Image</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $pageType = 'posts';
            $authors = getAuthors();
            echo '<br>';
            $data = getSearchData($res);
            $totalPageCount = ceil(count($data) / ITEMS_PER_PAGE);
            if ($currentPage > $totalPageCount) $currentPage--;

            $start = ($currentPage - 1) * ITEMS_PER_PAGE;
            $limit = ITEMS_PER_PAGE;
            if($start+$limit > count($data)){
                $limit = count($data) - $start;
            }

            for($i=$start; $i<$start+$limit; $i++){
                echo '<tr><td>'.($i+1).'</td>';
                echo '<td>'.$data[$i]['date_created'].'</td>';
                echo '<td>'.$data[$i]['title'].'</td>';
                echo '<td>'.$data[$i]['content'].'</td>';
                echo '<td>'.getAuthorNameById($data[$i]['author_id']).'</td>';
                echo '<td><img width="100px" src="img/'.getImageNameById($data[$i]['id']).'"</td>';
            }
            ?>

</tbody>
</table>

<?php
include 'pagination.php';
?>
