<!--/**
* Created by PhpStorm.
* User: hrant
* Date: 8/11/16
* Time: 1:09 PM
*/-->

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
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Home Page</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
<?php
require_once "UserNameController.php";
require_once "UserNameModel.php";
require_once "UserNameView.php";

$userNameModel = new UserNameModel();
$userNameController = new UserNameController($userNameModel);
$userNameView = new UserNameView($userNameModel);


if(isset($_GET['username'])){
    $username = NULL;
    $username = $_GET['username'];
    $userNameController->setUserName($username);
}

$userNameView->output();
?>

            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html>