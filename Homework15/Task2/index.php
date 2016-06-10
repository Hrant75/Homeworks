<!DOCTYPE html>
<html>
<head>
    <title>Writing into the file</title>
    <meta charset="UTF-8">
    <link href="main.css" type="text/css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <br><br>
    <p>Writing into the file</p>

    <form action="index.php">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" name="name">
        </div>
        <div class="form-group">
            <label for="last">Last Name</label>
            <input type="text" class="form-control" id="last" placeholder="Last Name"  name="last">
        </div>
        <div class="form-group">
            <label for="eMail">e-mail</label>
            <input type="email" class="form-control" id="email" placeholder="eMail" name="email">
        </div>
        <br><br>
        <button type="submit" class="btn btn-default">Write to file</button>
    </form>
    <form action="read.php">
        <button type="submit" class="btn btn-default">Read from file</button>
    </form>
    <br><br>

    <?php
    if( isset($_GET['name']) && isset($_GET['last']) && isset($_GET['email']) )
    {
        $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
        fwrite($myfile, $_GET['name']." ");
        fwrite($myfile, $_GET['last']." ");
        fwrite($myfile, ($_GET['email']."\n") );
        fclose($myfile);
    } else {
        echo 'please fill in all filds';
    }
    ?>

</div>

</body>
</html>