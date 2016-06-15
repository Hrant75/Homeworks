<html>
    <head>
        <title>Friday 13's</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        if(isset($_GET['year'])){
            $currentYear = $_GET['year'];
        }else {
            $currentYear = '2016';
        }
        ?>

        <div class="container">
            <br><h3>Calculate Friday 13's</h3>
            <div class="row">
                <div class="ol-md-offset-4 col-md-4">
            <br>
            <form action="<?=$_SERVER["PHP_SELF"]?>">
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" value="<?=$currentYear?>" max="9999" id="year" name="year" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-info form-control">Calculate Friday 13's of this year</button>
            </form>
            <div class="alert alert-info" role="alert">
                <?php

                function friday13($year){
                    $count = 0;
                    $days = [];

                    for($i = 1; $i < 13; $i++){
                        $mk = mktime(0,0,0,$i,13,$year);
                        if(date("w", $mk) == 5){
                            $count++;
                            $days[] = $mk;
                        }
                    }

                    if (count($days)>1){
                        echo 'There are '.$count.' "Friday 13"s in '.$year.'<br> And they are ';
                        for($i=0; $i<count($days); $i++) {
                            echo date("d-m-Y", $days[$i]);
                            if ($i == count($days) - 1) {
                                echo '.';
                            } else {
                                echo ', ';
                            }
                        }
                    } else {
                        echo 'There is only one "Friday 13" in '.$year.'<br>';
                        echo 'And this date is '.date("d-m-Y",$days[0]);
                    }
                }

                friday13($currentYear);
                ?>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </body>
</html>



