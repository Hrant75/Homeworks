<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Table and Pagination with PHP</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="padding-top: 30px">

    <?php

    // if Delete row
    if (isset($_POST['delButton'])){
        $delRow = $_POST['delButton'];

        $myArray = [];
        $i=0;
        $myfile = fopen("array1.txt", "r") or die("Unable to open file!");
        while(!feof($myfile)) {
            if($i != $delRow) {
                $myArray[$i] = fgets($myfile);
            } else {
                $tmp = fgets($myfile);
            }
            $i++;
        }
        fclose($myfile);


        $myfile = fopen("array1.txt", "w") or die("Unable to open file!");
        foreach ($myArray as $index){
            fwrite($myfile, $index);
        }
        fclose($myfile);

    }

                    // if Add pushed then add data into file
    if (isset($_POST['name']) && isset($_POST['lastname']) && $_POST['name'] != '' && $_POST['lastname'] != ''){
        $myfile = fopen("array1.txt", "a") or die("Unable to open file!");
        fwrite($myfile, $_POST['name']." ".$_POST['lastname']."\n");
        fclose($myfile);
    }

                            //    reading from file to array
    $myArray = [];
    $myAssArray = array();
    $i=0;

    $myfile = fopen("array1.txt", "r") or die("Unable to open file!");

    while(!feof($myfile)) {
        $tmp = explode(" ",fgets($myfile));

        if($tmp[0] != NULL ) {
            $myAssArray['name'] = $tmp[0];
            $myAssArray['last'] = $tmp[1];
            $myArray[$i] = $myAssArray;
            $i++;
        }
    }
//    array_pop($myArray);
    fclose($myfile);


        define("ITEMS_PER_PAGE",4);  //haytararum enq konsant

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
    <div class="container">
        <form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>First Name</th><th>Last Name</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                    for($i=$start; $i<$start+$limit; $i++){
                        echo '<tr>';
                        echo '<td>'.$myArray[$i]["name"].'</td>';
                        echo '<td>'.$myArray[$i]["last"].'</td>';
                        echo '<input type="hidden" name="page" value="';
                        if(count($myArray)%ITEMS_PER_PAGE == 1){
                            echo $currentPage-1;
                        }else {
                            echo $currentPage;
                        };
                        echo '"> <td>
                                <button type="submit" class="btn btn-default" name="delButton" value="'.$i.'">Delete Row</button>';
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
                            echo '<a href="index.php?page='.($currentPage-1).'" ';
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
                    echo '<li class=" '.$class.' "><a href="index.php?page=' . $i . ' "style="' . $style . '">' . $i . '</a></li>';
                }
                ?>

                <li>
                    <?php
                        if ($currentPage == $totalPageCount){
                            echo '<a href="#" style="color:black"';
                        }else{
                            echo '<a href="index.php?page='.($currentPage+1).'" ';
                        }
                    ?>aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <form class="form-inline" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
            <?php
            echo '<input type="hidden" name="page" value="';
            if(count($myArray)%ITEMS_PER_PAGE == 0){
                echo $currentPage+1;
            }else {
                echo $currentPage;
            }
            echo '">';?>
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" class="form-control" id="name" placeholder="First name" name="name" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" placeholder="Last Name"  name="lastname" required>
            </div>
            <button type="submit" class="btn btn-default">Add data</button>
        </form>


    </div>

</body>
</html>