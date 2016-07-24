<?php
require_once "OOP_Engine.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News - admin panel</title>
<!--        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <br>
            <ul class="nav nav-pills nav-stacked">
                <li <?php if($pageType=='news') {echoActiveHere();} ?> ><a href="admin.php?pageType=news">News</a> </li>
                <li <?php if($pageType=='categories') {echoActiveHere();} ?> ><a href="admin.php?pageType=categories">Categories</a> </li>
            </ul>
            <br><br>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal">
                Add
            </button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#updateModal">
                Update
            </button>

        </div>

        <div class="col-md-9">
            <?php
            if($pageType=='categories') {
                include 'categories.php';
            } else if($pageType=='news') {
                include 'news.php';
            }
            ?>
        </div>
    </div>
</div>
<?php
require_once 'addmodal.php';
require_once 'updatemodal.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="script.js"></script>
</body>
</html>