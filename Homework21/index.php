<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Table and Pagination with PHP</title>
    <link href="main.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<?php

define("ITEMS_PER_PAGE",4);  //haytararum enq konsant

$subjectsArray = [];
$studentsArray = [];
$tmpAssortedArray = array();
$studentsCurrentPage = 0;
$coursesCurrentPage = 0;
$tmpArray = [];
$myArray = [];
$i=0;
$coursesHeader = ['Course Name', 'Lecturer'];
$studentsHeader = ["First Name", 'Last Name', 'Course Name'];

if(isset($_GET['side'])){
    $pageType = $_GET['side'];
} else {
    $pageType = 'courses';
}

// if Add pushed then add data into file
if (isset($_POST['add'])){
    if(isset($_POST['addcourses'])){
        $pageType = 'courses';
        $myfile = fopen("courses.txt", "a") or die("Unable to open file!");
        for($i=0; $i<count($coursesHeader); $i++){
            fwrite($myfile, $_POST[$i]);
            if($i<(count($coursesHeader)-1) ){
                fwrite($myfile, " | ");
            } else {
                fwrite($myfile, "\n");
            }
        }
        fclose($myfile);
    }
    if(isset($_POST['addstudents'])) {
        if (isset($_POST['addstudents'])) {
            $pageType = 'students';
            $myfile = fopen("students.txt", "a") or die("Unable to open file!");
            for ($i = 0; $i < count($studentsHeader); $i++) {
                fwrite($myfile, $_POST[$i]);
                if ($i < (count($studentsHeader) - 1)) {
                    fwrite($myfile, " | ");
                } else {
                    fwrite($myfile, "\n");
                }
            }
            fclose($myfile);
        }
    }
}

// if Delete row
if (isset($_POST['delButton'])){
    $delRow = $_POST['delButton'];
    $pageType = $_POST['delSide'];

    $myArray = [];
    $i=0;
    $myfile = fopen($pageType.'.txt', "r") or die("Unable to open file!");
    while(!feof($myfile)) {
        if($i != $delRow) {
            $myArray[$i] = fgets($myfile);
        } else {
            $tmp = fgets($myfile);
        }
        $i++;
    }
    fclose($myfile);


    $myfile = fopen("$pageType.txt", "w") or die("Unable to open file!");
    foreach ($myArray as $index){
        fwrite($myfile, $index);
    }
    fclose($myfile);

}

//    reading from file to array
$i = 0;
$myArray= [];
$myfile = fopen($pageType.".txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
    $tmp = explode(" | ",fgets($myfile));
    if($tmp[0] != NULL ) {
        $myArray[$i] = $tmp;}
    $i++;
}
fclose($myfile);

$columnCount = count($myArray[0]);

$currentPage = 1;
if(isset($_GET['page'])){
    $currentPage = $_GET['page'];
}
if(isset($_POST['page'])){
    $currentPage = $_POST['page'];
}

$totalPageCount = ceil(count($myArray) / ITEMS_PER_PAGE);
$start = ($currentPage - 1) * ITEMS_PER_PAGE;
$limit = ITEMS_PER_PAGE;
if($start+$limit > count($myArray)){
    $limit = count($myArray) - $start;
}

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="box">
                            <a href="index.php?side=courses">
                                <h3 <?php if($pageType=='courses') echo ' style="text-decoration:underline" '?>
                                >Courses</h3>
                            </a>
                        </div>
                        <div class="box">
                            <a href="index.php?side=students">
                                <h3 <?php if($pageType=='students') echo ' style="text-decoration:underline" '?>
                                >Students</h3>
                            </a>
                        </div>

                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal">
                            Add
                        </button>

                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form class="form" action="index.php" method="post">
                                        <?php
                                        for ($i = 0; $i<$columnCount; $i++){
                                            echo '<div class="form-group">
                                            <label for="'.$i.'">';
                                            echo ($pageType=='courses')? $coursesHeader[$i]:$studentsHeader[$i];
                                            echo '</label>
                                            <input type="text" class="form-control" id="'.$i.'" name="'.$i.'" required>
                                            </div>';
                                        }
                                        ?>

                                        <input type="hidden" name="add<?=$pageType?>">
                                        <button type="submit" class="btn btn-default btn-sm" name="add">Add data</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10">

                <div class="row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="row">
                            <?php

                                echo '<form action="index.php" method="post">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                            <th>#</th>';
                                                for ($i = 0; $i<$columnCount; $i++){
                                                    echo '<th>';
                                                    if($pageType == 'courses'){
                                                        echo $coursesHeader[$i];
                                                    } else {
                                                        echo $studentsHeader[$i];
                                                    }
                                                    echo '</th>';
                                                }

                                            echo '</tr>
                                            </thead>
                                            <tbody>';

                                for($i=$start; $i<$start+$limit; $i++){
                                    echo '<tr><td>'.($i+1).'</td>';

                                        for ($j = 0; $j<$columnCount; $j++){
                                            echo '<td>'.$myArray[$i][$j].'</td>';
                                        }


                                    echo ' <td>
                                           <input type="hidden" name="delSide" value="'.$pageType.'"> 
                                        <button type="submit" class="btn btn-default btn-sm" name="delButton" value="' . $i . '">Delete Row</button>';
                                    echo '</td> </tr>';
                                }

                            ?>

                                    </tbody>
                                </table>
                            </form>

                            <nav class="text-center">
                                <ul class="pagination">
                                    <li>
                                        <?php
                                        if ($currentPage < 2){
                                            echo '<a href="#" style="color:black"';
                                        }else{
                                            echo '<a href="index.php?page='.($currentPage-1).'&side='.$pageType.'" ';
                                        }
                                        ?>
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <?php
                                    for($i=1;$i<=$totalPageCount;$i++) {
                                        $style = '';
                                        $class='';
                                        if ($i == $currentPage) {
                                            $style = "font-weight: bold;";
                                            $class = "active";
                                        }
                                        echo '<li class=" '.$class.' "><a href="index.php?page=' . $i .'&side='.$pageType. ' "style="' . $style . '">' . $i . '</a></li>';
                                    }
                                    ?>

                                    <li>
                                        <?php
                                        if ($currentPage == $totalPageCount){
                                            echo '<a href="#" style="color:black"';
                                        }else{
                                            echo '<a href="index.php?page='.($currentPage+1).'&side='.$pageType.'" ';
                                        }
                                        ?>aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</body>
</html>