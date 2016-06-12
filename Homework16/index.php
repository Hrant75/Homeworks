<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Table and Pagination with PHP</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php
        $myArray = [
            ['name'=>'Hrant','last'=>'Hayrapetyan_1'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_2'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_3'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_4'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_5'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_6'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_7'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_8'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_9'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_10'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_11'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_12'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_13'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_14'],
            ['name'=>'Hrant','last'=>'Hayrapetyan_15']
        ];

        define("ITEMS_PER_PAGE",4);  //haytararum enq konsant

        $currentPage = 1;
        if(isset($_GET['page'])){
            $currentPage = $_GET['page'];
        }
        $totalPageCount = ceil(count($myArray) / ITEMS_PER_PAGE);

        $start = ($currentPage - 1) * ITEMS_PER_PAGE;
        $limit = ITEMS_PER_PAGE;

        if($start+$limit > count($myArray)){
            $limit = count($myArray) - $start;
        }
    ?>
    <div class="container">
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
                    echo '</tr>';
                }
            ?>

            </tbody>
        </table>
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
        <form class="form-inline">
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" class="form-control" id="name" placeholder="First name" name="name">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" placeholder="Last Name"  name="lastname">
            </div>
            <button type="submit" class="btn btn-default">Add data</button>
        </form>


    </div>

</nav>

</body>
</html>