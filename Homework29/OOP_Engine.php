<?php

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

//if($pageType == 'news'){     $tableName = 'news'; }
//if($pageType == 'categories'){     $tableName = 'categories'; }

function echoActiveHere(){
    echo ' class="active"';
}

require_once 'DbConnection.php';
require_once 'CategoryModel.php';
require_once 'CategoryRow.php';
require_once 'NewsRow.php';
require_once 'NewsModel.php';

$newsModel = new NewsModel();
$newsRow = new NewsRow();

$categoryModel = new CategoryModel();
$categoryRow = new CategoryRow();

if(isset($_GET['delButton'])) {
    $deleteRow = $_GET['delButton'];
    if ($pageType == 'categories') $categoryModel->deleteCategory($deleteRow);
    if ($pageType == 'news') $newsModel->deleteNews($deleteRow);
}


if(isset($_POST['add'])){
    $pageType = $_POST['add'];
    $currentPage = $_POST['currentPage'];

//    if ( (count($data) % ITEMS_PER_PAGE) == 0) $currentPage++;

    if($_POST['add'] == 'categories' ){
        if ( (count($categoryModel->getCategories()) % ITEMS_PER_PAGE) == 0) $currentPage++;
        $pageType = 'categories';
        $categoryName = $_POST['addCategory'];
        $categoryRow->setCategory($categoryName);
        $categoryModel->saveCategory($categoryRow);
    }

    if($_POST['add'] == 'news'){
        if ( (count($newsModel->getData(NULL)) % ITEMS_PER_PAGE) == 0) $currentPage++;
        $pageType = 'news';
        $title =  $_POST['addTitle'];
        $contnet =  $_POST['addContent'];
        $category_id =  $_POST['addCategoryID'];
        $newsRow->setTitle($title);
        $newsRow->setContent($contnet);
        $newsRow->setCategory($category_id);
        $newsModel->saveNews($newsRow);
    }
}

?>