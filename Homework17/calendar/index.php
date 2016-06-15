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
                padding-left: 10px;
                color: #4d4d4d;
                font-size: 34px;
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
            .calendarHeaderElements{
                height: 30px;
                text-align: center;
                font-size: 20px;
            }
            .clearfix:after {
                content: " ";
                display: block;
                width: 100%;
                height: 0;
                clear: both;
            }
        </style>
    </head>
    <body>
        <?php
            if( isset($_GET['year']) && isset($_GET['month']) && ($_GET['year'] > 0 && $_GET['year'] < 9999)
                && ($_GET['month'] > 0 && $_GET['month'] < 13) ){
                $currentYear = $_GET['year'];
                $currentMonth = $_GET['month'];

            }else {
                $currentYear = date('Y');
                $currentMonth = date('m');
            }

            $mk = mktime(0,0,0,$currentMonth, 1, $currentYear);
            $daysOfMonth = date("t",$mk);
            $emptyCells = date("N",$mk) - 1;
            $fullUp = ceil( ($emptyCells + $daysOfMonth)/7 )*7-($emptyCells + $daysOfMonth);
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
                        <div class="clearfix">
                            <?php
                            $weekDays = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
                            foreach ($weekDays as $wDay){
                                    echo '<div class="box calendarHeaderElements">';
                                    echo $wDay;
                                    echo '</div>';
                                }
                        echo '</div><br>';

                            for($i=0; $i<$emptyCells; $i++){
                                echo '<div class="box empty">';
                                echo '</div>';
                            }

                            for($i=0; $i<$daysOfMonth; $i++){
                                echo '<div class="box full">';
                                echo $i+1;
                                echo '</div>';
                            }

                            for($i=0; $i<$fullUp; $i++){
                                echo '<div class="box empty">';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>



