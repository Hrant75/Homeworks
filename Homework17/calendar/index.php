<html>
    <head>
        <title>Calendar</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .box{
                float: left;
                display: inline-block;
                width: 100px;
                height: 100px;
                border: 1px solid #e4e4e4;
                text-align: center;
            }
            .empty{
                background-color: beige;
            }
            .full{
                background-color: aqua;
            }
            .myContainer{
                width:750px;
            }
        </style>
    </head>
    <body>
        <?php
            if(isset($_GET['year']) && isset($_GET['month'])){
                $currentYear = $_GET['year'];
                $currentMonth = $_GET['month'];

            }else {
                $currentYear = date('Y');
                $currentMonth = date('m');
            }

            $mk = mktime(0,0,0,$currentMonth, 1, $currentYear);
            $currentTime = date("d-m-Y", $mk);
            $firstDay = date("N",$mk);
            $daysOfMonth = date("t",$mk);
            $emptyCells = $firstDay - 1;
//            $fullUp = ceil(($emptyCells + $daysOfMonth)/7)*7-($emptyCells + $daysOfMonth);
//        echo $fullUp;
//            echo 'if true '.$currentYear.' '.$currentMonth.'<br>';
//            echo $currentTime.' first day '.$firstDay.' empty cells '.$emptyCells.' day of month '.$daysOfMonth.'<br>';
        ?>

        <div class="container">
            <br><h2>Calendar</h2>
            <div class="row">
                <div class="col-md-2">
                    <form action="<?=$_SERVER["PHP_SELF"]?>">
                        <div class="form-group">
                            <label for="year">Year</label>
                            <input type="number" value="<?=$currentYear?>" max="9999" id="year" name="year" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="month">Month</label>
                            <input type="number" value="<?=$currentMonth?>" min="01" max="12" id="month" name="month" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-info form-control">Get Calendar</button>
                    </form>
                </div>
                <div class="col-md-10">
                    <div class="myContainer">
                        <?php

                            for($i=0; $i<$emptyCells; $i++){
                                echo '<div class="box empty">';
                                echo '</div>';
                            }

                            for($i=0; $i<$daysOfMonth; $i++){
                                echo '<div class="box full">';
                                echo $i+1;
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>


<!---->
<!--            -->
<!--            <div class="row">-->
<!--            <br>-->
<!--            <form action="--><?//=$_SERVER["PHP_SELF"]?><!--">-->
<!--                <div class="form-group">-->
<!--                    <label for="year">Year</label>-->
<!--                    <input type="number" value="--><?//=$currentYear?><!--" max="9999" id="year" name="year" class="form-control" required>-->
<!--                </div>-->
<!--                <button type="submit" class="btn btn-info form-control">Calculate Friday 13's of this year</button>-->
<!--            </form>-->
<!--            <div class="alert alert-info" role="alert">-->
<!--                --><?php
//
//                function friday13($year){
//                    $count = 0;
//                    $days = [];
//
//                    for($i = 1; $i < 13; $i++){
//                        $mk = mktime(0,0,0,$i,13,$year);
//                        if(date("w", $mk) == 5){
//                            $count++;
//                            $days[] = $mk;
//                        }
//                    }
//
//                    if (count($days)>1){
//                        echo 'There are '.$count.' "Friday 13"s in '.$year.'<br> And they are ';
//                        for($i=0; $i<count($days); $i++) {
//                            echo date("d-m-Y", $days[$i]);
//                            if ($i == count($days) - 1) {
//                                echo '.';
//                            } else {
//                                echo ', ';
//                            }
//                        }
//                    } else {
//                        echo 'There is only one "Friday 13" in '.$year.'<br>';
//                        echo 'And this date is '.date("d-m-Y",$days[0]);
//                    }
//                }
//
//                friday13($currentYear);
//                ?>
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-4">-->
<!--            </div>-->
<!--        </div>-->
    </body>
</html>


