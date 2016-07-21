<!DOCTYPE html>
<head>
    <title>Draw table with OOP</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="padding-top: 50px">

    <div class="container">
        <div class="row">

            <form action="index.php">
                <div class="form-group">
                    <label for="columnInput">Row #</label>
                    <input type="number" class="btn btn-info" min="1" id="columnInput" name="columnInput" required>
                </div>
                <button type="submit" class="btn btn-info">Set column count</button>
            </form>
            <br><br>


<?php

require 'table.php';

if(isset($_GET['columnInput'])){
    $column_count = $_GET['columnInput'];
} else {
    die;
}

$table = new Table();
$rows = [];

for ($i=0; $i<$column_count; $i++){
    $row = [];
    for ($j=0; $j<$column_count; $j++){
        $row[] = ($i+1)*($j+1);
    }
    $rows[] = $row;
}

foreach ($rows as $row ){
    $tableRow = new Row();
    $tableRow->setContent($row);

    $table->addTableRows($tableRow);
}

$table->drawTable();
?>


        </div>
    </div>
</body>

