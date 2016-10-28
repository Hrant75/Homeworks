<?php
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "ikarus");
define('DB_NAME', "day23");
define("UPLOAD_DIR", "img/");

// Create connection
$dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}
define("ITEMS_PER_PAGE",4);  //haytararum enq konsant

if(isset($_GET['currentPage'])){
    $currentPage = $_GET['currentPage'];
} else {
    $currentPage = 1;
}

if(isset($_GET['pageType'])){
    $pageType = $_GET['pageType'];
} else {
    $pageType = 'posts';
}

if(isset($_POST['add'])){
    $pageType = $_POST['add'];
    $currentPage = $_POST['currentPage'];
}

if($pageType == 'posts'){     $tableName = 'blog_posts'; }
if($pageType == 'categories'){     $tableName = 'blog_post_categories'; }
if($pageType == 'authors'){     $tableName = 'blog_post_authors'; }

function echoActiveHere(){
    echo ' class="active"';
}

function getData()
{
    global $dbConnection;
    global $tableName;

    $data = [];
    $sql = "SELECT * FROM ".$tableName;
    $result = mysqli_query($dbConnection, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
//            $posts[] = array('id' => $row['id'], 'content' => strtolower($row['title'].' '.$row['content']));

        }
        return $data;
    } else return false;

//    require_once "setindex.php";

}

function getAuthors()
{
    global $dbConnection;

    $data = [];
    $sql = "SELECT * FROM blog_post_authors";
    $result = mysqli_query($dbConnection, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    } else return false;
}

function getAuthorNameById($id){
    global $dbConnection;

    $data = [];
    $sql = "SELECT name FROM blog_post_authors WHERE id=".$id;
    $result = mysqli_query($dbConnection, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data[0]['name'];
    } else return false;
}

function getImageNameById($id){
    global $dbConnection;

    $data = [];
    $sql = "SELECT file_name FROM media WHERE blog_post_id=".$id;
    $result = mysqli_query($dbConnection, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data[0]['file_name'];
    } else return false;
}

if(isset($_POST['add'])){

    $data = getData();
    if ( (count($data) % ITEMS_PER_PAGE) == 0) $currentPage++;

    if($_POST['add'] == 'categories' ){
        $pageType = 'categories';
        $categoryName = $_POST['addCategory'];
        $sql = "INSERT INTO blog_post_categories (title) VALUES ('".$categoryName."')";
    }

    if($_POST['add'] == 'posts'){

        $pageType = 'posts';
        $title =  $_POST['addTitle'];
        $contnet =  $_POST['addContent'];
        $author_id =  $_POST['addAutorID'];
        $sql = "INSERT INTO blog_posts (title, content, author_id) VALUES ('".$title."', '".$contnet."', '".$author_id."')";
        $result = mysqli_query($dbConnection, $sql);

        if (!empty($_FILES["uploadFile"])) {
            $uploadFile = $_FILES["uploadFile"];
            if ($uploadFile["error"] !== UPLOAD_ERR_OK) {
                echo "<p>An error occurred.</p>";
                exit;
            }
            if ( $uploadFile['type']!= "image/gif" && $uploadFile['type']!= "image/gif"  && $uploadFile['type']!= "image/png" && $uploadFile['type']!= "image/jpeg" && $uploadFile['type']!= "image/JPEG" && $uploadFile['type']!= "image/PNG" && $uploadFile['type']!= "image/GIF"){
                echo 'this file type is '.$uploadFile['type'].'<br>';
                echo "<p>Please upload image.</p>";
                exit;
            }
            $name = preg_replace("/[^A-Z0-9._-]/i", "_", $uploadFile["name"]);
            $i = 0;
            $parts = pathinfo($name);
            while (file_exists(UPLOAD_DIR . $name)) {
                $i++;
                $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
            }
            $success = move_uploaded_file($uploadFile["tmp_name"],
                UPLOAD_DIR . $name);
            if (!$success) {
                echo "<p>Unable to save file.</p>";
                exit;
            }
            chmod(UPLOAD_DIR . $name, 0777);

            mysqli_query($dbConnection, "INSERT INTO media (blog_post_id, file_name) VALUES ('".mysqli_insert_id($dbConnection)."', '".$name."')");
        }
        if(!$result){
            echo 'false --'.$sql.'<br>';
            return false;
        }
        return true;
    }
    
    if($_POST['add'] == 'authors'){

        $pageType = 'authors';
        $name =  $_POST['addAuthor'];
        $sql = "INSERT INTO blog_post_authors (name) VALUES ('".$name."')";
    }
    $result = mysqli_query($dbConnection, $sql);

    if(!$result){
        echo 'false --'.$sql.'<br>';
        return false;
    }
    return true;
}

if(isset($_GET['delButton'])) {
    $deleteRow = $_GET['delButton'];

    if($pageType=='posts'){
        if(file_exists('img/'.getImageNameById($deleteRow))){
            unlink('img/'.getImageNameById($deleteRow));
        }
    }

    $sql = "DELETE FROM ".$tableName." WHERE id =".$deleteRow;
    $result = mysqli_query($dbConnection, $sql);

    if (!$result) {
        echo 'false --';
        echo $sql.'<br>';
        return false;
    }
    return true;
}

function updateStudent(){
    if(isset($_GET['update_student'])){
        global $dbConnection;

        $updateRow = $_GET['update_student'];
        $first_name =  $_GET['first_name'];
        $last_name =  $_GET['last_name'];
        if(isset($_GET['age'])){
            $age =  $_GET['age'];
        } else {
            $age = '20';
        }

        $sql = "UPDATE students SET first_name='".$first_name."', last_name='".$last_name."', age='".$age."' WHERE id='".$updateRow."'";

        $result = mysqli_query($dbConnection, $sql);

        if(!$result){
            echo 'false';
            return false;
        }
        return true;
    }
}

function getSearchData($res)
{
    global $dbConnection;

    $data = [];

    for($i=0; $i<count($res); $i++){
        $sql = "SELECT * FROM blog_posts WHERE id=".$res[$i];
        $result = mysqli_query($dbConnection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;

            }
        } else return false;
    }
    return $data;

}

function getAutors(){

}
?>