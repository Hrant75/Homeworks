<html>
<head>
    <title>Calendar</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<!--    <link href="style.css" rel="stylesheet">-->
</head>
<body>
    <div class="container" style="padding-top: 50px">
    <?php
        session_start();

        if(isset($_POST['signUpUserName']) && isset($_POST['signUpPassword'])){
            // if  add username paswword into file
                $myfile = fopen("pass.txt", "a") or die("Unable to open file!");
                fwrite($myfile, $_POST['signUpUserName']." ".$_POST['signUpPassword']."\n");
                fclose($myfile);
        }

        if(isset($_POST['logout'])){
            $_SESSION['logined'] = false;
        }

        if(isset($_POST['username']) && isset($_POST['password'])){
            // check username password
            $myfile = fopen("pass.txt", "r") or die("Unable to open file!");
            while(!feof($myfile)) {
                $tmp = explode(" ",fgets($myfile));
                $tmpUsername = chop($tmp[0]);
                $tmpPassword = chop($tmp[1]);
                if($_POST['username'] == $tmpUsername && $_POST['password'] == $tmpPassword){
                    $_SESSION['logined'] = true;
                    break;
                } else {
                    $_SESSION['logined'] = false;
                }
            }
        }
        if (!$_SESSION['logined']){
            echo '<form action="index.php" method="post">
                <div class="form-inline">
                    <input type="text" name="username" class="form-control" required>
                    <label for="signUpUserName">User Name</label>
                </div>
                <br>
                <div class="form-inline">
                    <input type="password" name="password" class="form-control" required>
                    <label for="signUpUserName">Password</label>
                </div>
                <br>
                <input type="submit" class="btn btn-default" value="Log in">
                <span> </span>
                <a class="btn btn-info form-inline" href="signup.php">Register</a>
            </form>';
        } else {
            echo '<h1>LOGINED</h1>';
            echo '<br><br>';
            echo '<form action="index.php" method="post">
                <input type="hidden" name="logout" value="logout" title="User Name">
                <input type="submit" class="btn btn-default" value="Log out">
            </form>';
        }
    ?>
    </div>
</body>
</html>


