<?php
if(isset($_GET['pageType'])){
    $pageType = $_GET['pageType'];
} else {
    $pageType = 'students';
}
if(isset($_GET['add'])){
    $pageType = $_GET['add'];
}
if(isset($_GET['currentPage'])){
    $currentPage = $_GET['currentPage'];
} else {
    $currentPage = 1;
}

function echoActiveHere(){
    echo ' class="active"';
}
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
                    <li <?php if($pageType=='students') {echoActiveHere();} ?> ><a href="index.php?pageType=students">Students</a> </li>
                    <li <?php if($pageType=='lecturers') {echoActiveHere();} ?> ><a href="index.php?pageType=lecturers">Lecturers</a> </li>
                    <li <?php if($pageType=='courses') {echoActiveHere();} ?> ><a href="index.php?pageType=courses">Courses</a> </li>
                </ul>
                <br><br>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal">
                    Add
                </button>

            </div>

            <div class="col-md-9">
                <?php 
                    if($pageType=='courses') {
                        include 'courses.php';
                    } else if($pageType=='lecturers') {
                        include 'lecturers.php';
                    } else {
                        include 'students.php';
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form" action="index.php">
                    <?php
                    if($pageType=='courses') {
                        echo '
                            <div class="form-group">
                                <label for="addCourse">Add Course</label>
                                <input type="text" class="form-control" id="addCourse" name="addCourse" oninput="courseName()" required>
                            </div>
                            <div class="alert alert-danger courseNameAlert" role="alert">
                                The course name should be 2-20 characters with
                            </div>
                            <div class="form-group">
                                <label for="addLecturerID">Add Course</label>
                                <input type="number" class="form-control" min="1" id="addLecturerID" name="addLecturerID" required>
                            </div>';
                    } else if($pageType=='lecturers' || $pageType=='students' ) {
                        echo '
                            <div class="form-group">
                                <label for="addName">First Name</label>
                                <input type="text" class="form-control" id="addName" name="addName" oninput="checkName()" required>
                            </div>
                            <div class="alert alert-danger nameAlert" role="alert">
                                The name should be 2-20 characters with capital first letter
                            </div>
                            <div class="form-group">
                                <label for="addLast">Last Name</label>
                                <input type="text" class="form-control" id="addLast" name="addLast" oninput="checkLast()" required>
                            </div>                            
                            <div class="alert alert-danger lastAlert" role="alert">
                                The last name should be 2-40 characters with capital first letter
                            </div>';
                        if( $pageType=='students' ){
                            echo '<div class="form-group">
                                <label for="addAge">Age</label>
                                <input type="number" class="form-control" min="16" max="90" id="addAge" name="addAge">
                            </div>'; }
                            echo '<div class="form-group">
                                <label for="addEmail">Email</label>
                                <input type="text" class="form-control" id="addEmail" name="addEmail" oninput="checkEmail()" >
                            </div>                            
                            <div class="alert alert-danger emailAlert" role="alert">
                                Please input valid e-mail
                            </div>
                            <div class="form-group">
                                <label for="addPhone">Phone</label>
                                <input type="text" class="form-control" id="addPhone" name="addPhone" oninput="checkPhone()">
                            </div>                            
                            <div class="alert alert-danger phoneAlert" role="alert">
                                Please input valid phone in 012-345678 and (078)789789 form
                            </div>
                            <div class="form-group">
                                <label for="addGit">Git URL</label>
                                <input type="text" class="form-control" id="addGit" name="addGit" oninput="checkURL()">
                            </div>                            
                            <div class="alert alert-danger urlAlert" role="alert">
                                Please input valid git url
                            </div>';
                    } 
                    echo '
                        <input type="hidden" name="currentPage" value='.$currentPage.'>
                        <button type="submit" id="addButton" class="btn btn-default" name="add" value='.$pageType.'>Add</button>';
                    ?>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>