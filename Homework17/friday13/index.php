<html>
    <head>
        <title>Friday 13's</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="ol-md-offset-4 col-md-4">
            <br><br><br>
            <form action="<?=$_SERVER["PHP_SELF"]?>">
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" value="2016" max="9999" id="year" name="year" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-info form-control">Calculate Friday 13's of this year</button>
            </form>
            <div class="alert alert-info" role="alert">
                <?php

                function friday13($year){
                    $count = 0;

                    for($i = 1; $i < 13; $i++){
                        if(date("w", mktime(0,0,0,$i,13,$year)) == 5){
                            $count++;
                        }
                    }
                    echo 'There is '.$count.' "Friday 13"';
                    echo ($count > 1 ? 's' : '');
                    echo ' in '.$year.'<br>';
                }

                if(isset($_GET['year'])){
                    friday13($_GET['year']);
                }
                ?>
            </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </body>
</html>



