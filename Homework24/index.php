<?php
require_once "engine.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students, Lecturers & Courses</title>
<!--    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">-->
            <link href="bootstrap.min.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <br>
                <ul class="nav nav-pills nav-stacked">
                    <li <?php if($pageType=='categories') {echoActiveHere();} ?> ><a href="index.php?pageType=categories">Categories</a> </li>
                    <li <?php if($pageType=='posts') {echoActiveHere();} ?> ><a href="index.php?pageType=posts">Posts</a> </li>
                    <li <?php if($pageType=='authors') {echoActiveHere();} ?> ><a href="index.php?pageType=authors">Authors</a> </li>
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

                <form class="form form-inline searchForm pull-right" action="index.php">
                        <div class="form-group">
                            <input type="text" class="form-control" id="searchInput" name="searchInput"" required>
                        </div>
                    <button type="submit" id="searchButton" class="btn btn-default" name="pageType" value="search">Search</button>
                </form>
                
                <?php
                if($pageType=='categories') {
                    include 'categories.php';
                } else if($pageType=='posts') {
                    include 'posts.php';
                }  else if($pageType=='authors') {
                    include 'authors.php';
                }  else if($pageType=='authors') {
                    include 'authors.php';
                }  else if($pageType=='search') {
                    include 'search.php';
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