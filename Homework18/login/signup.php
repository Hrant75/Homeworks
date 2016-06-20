<html>
<head>
    <title>Calendar</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!--    <link href="style.css" rel="stylesheet">-->
</head>
<body>
    <div class="container" style="padding-top: 50px">
        <form action="index.php" method="post">
            <div class="form-inline">
                <input type="text" name="signUpUserName" class="form-control" required>
                <label for="signUpUserName">User Name</label>
            </div>
            <br>
            <div class="form-inline">
                <input type="password" name="signUpPassword" class="form-control" required>
                <label for="signUpPassword">Password</label>
            </div>
            <br>
            <button type="submit" class="btn btn-info form-inline">Sign Up</button>
        </form>
    </div>
</body>