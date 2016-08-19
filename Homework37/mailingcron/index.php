<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>cron sending emails from DB</title>
    <link href="main.css" rel="stylesheet">
    <!--    <link href="bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container" style="padding-top:50px">
    <div class="row">
        
<?php

if(isset($_POST['add'])){
    require_once 'db.php';

    $sql = "INSERT INTO cron (message) VALUES ('".$_POST['message']."');";

    if (!mysqli_query($dbConnection, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
        <form class="form" method="post" action="index.php">
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control"  id="message" name="message" rows="10" required></textarea>
            </div>
            <button type="submit" class="btn btn-default" name="add">Send Email</button>
        </form>
    </div>
</div>

</body>
</html>
