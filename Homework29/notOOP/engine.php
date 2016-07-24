<?php
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "ikarus");
define('DB_NAME', "exam26");
define("UPLOAD_DIR", "img/");

// Create connection
$dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}
define("ITEMS_PER_PAGE",4);  //haytararum enq konsant
$fileName = end( explode('/', $_SERVER['PHP_SELF']) );

if(isset($_GET['currentPage'])){
    $currentPage = $_GET['currentPage'];
} else {
    $currentPage = 1;
}

if(isset($_GET['pageType'])){
    $pageType = $_GET['pageType'];
} else {
    $pageType = 'news';
}

$currentCategory = NULL;
if(isset($_GET['currentCategory'])){
    $currentCategory = $_GET['currentCategory'];
}

if(isset($_POST['add'])){
    $pageType = $_POST['add'];
    $currentPage = $_POST['currentPage'];
}

if($pageType == 'news'){     $tableName = 'news'; }
if($pageType == 'categories'){     $tableName = 'categories'; }

function echoActiveHere(){
    echo ' class="active"';
}

function getData($currentCategory = NULL)
{
    global $dbConnection;
    global $tableName;

    $data = [];
    
    $sql = "
    SELECT
        `news`.`id`,
        `news`.`date`,
        `news`.`title`,
        `news`.`content`,
        `categories`.`category`
    FROM `news`
    JOIN `categories` ON `news`.`category_id` = `categories`.`id`";

    if(!is_null($currentCategory)){
        $sql .= " WHERE `category_id` ='".$currentCategory."'";
    }
    
    $result = mysqli_query($dbConnection, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    } else return false;

}

if(isset($_GET['delButton'])) {
    $deleteRow = $_GET['delButton'];

    $sql = "DELETE FROM ".$tableName." WHERE id =".$deleteRow;
    $result = mysqli_query($dbConnection, $sql);

    if (!$result) {
        echo 'false --';
        echo $sql.'<br>';
        return false;
    }
    return true;
}

//function getImageNameById($id){
//    global $dbConnection;
//
//    $data = [];
//    $sql = "SELECT file_name FROM media WHERE blog_post_id=".$id;
//    $result = mysqli_query($dbConnection, $sql);
//
//    if (mysqli_num_rows($result) > 0) {
//        while($row = mysqli_fetch_assoc($result)) {
//            $data[] = $row;
//        }
//        return $data[0]['file_name'];
//    } else return false;
//}

if(isset($_POST['add'])){

    $data = getData();
    if ( (count($data) % ITEMS_PER_PAGE) == 0) $currentPage++;

    if($_POST['add'] == 'categories' ){
        $pageType = 'categories';
        $categoryName = $_POST['addCategory'];
        $sql = "INSERT INTO categories (category) VALUES ('".$categoryName."')";
    }

    if($_POST['add'] == 'news'){

        $pageType = 'news';
        $title =  $_POST['addTitle'];
        $contnet =  $_POST['addContent'];
        $category_id =  $_POST['addCategoryID'];
        $sql = "INSERT INTO news (title, content, category_id) VALUES ('".$title."', '".$contnet."', '".$category_id."')";
        $result = mysqli_query($dbConnection, $sql);

        if(!$result){
            echo 'false --'.$sql.'<br>';
            return false;
        }
        return true;
    }
    $result = mysqli_query($dbConnection, $sql);

    if(!$result){
        echo 'false --'.$sql.'<br>';
        return false;
    }
    return true;
}


//function updateStudent(){
//    if(isset($_GET['update_student'])){
//        global $dbConnection;
//
//        $updateRow = $_GET['update_student'];
//        $first_name =  $_GET['first_name'];
//        $last_name =  $_GET['last_name'];
//        if(isset($_GET['age'])){
//            $age =  $_GET['age'];
//        } else {
//            $age = '20';
//        }
//
//        $sql = "UPDATE students SET first_name='".$first_name."', last_name='".$last_name."', age='".$age."' WHERE id='".$updateRow."'";
//
//        $result = mysqli_query($dbConnection, $sql);
//
//        if(!$result){
//            echo 'false';
//            return false;
//        }
//        return true;
//    }
//}


function getCategories()
{
    global $dbConnection;

    $data = [];
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($dbConnection, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    } else return false;
}

function getCategoryNameById($id)
{
    global $dbConnection;

    $data = [];
    $sql = "SELECT category FROM categories WHERE id=" . $id;
    $result = mysqli_query($dbConnection, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data[0]['category'];
    }
}

?>