<?php
//    $content = [
//        ['page_type'=>'students', page_name=>'Students', 'header'=>'<th>#</th><th>First Name</th><th>Last name</th><th>Age</th><th>eMail</th><th>Phone</th>
//            <th>Git Address</th>', content=>'<tr><td>'.$students[$i]['id'].'</td><td>'.$students[$i]['first_name'].'</td><td>'.$students[$i]['last_name'].'</td><td>".$students[$i]["age"]."</td><td>".$students[$i]["phone"]."</td><td>".$students[$i]["email"]."</td><td>".$students[$i]["git"]."</td>'],
//        [],
//        []
//    ];
//?>

<h3 class="text-center">Students</h3>
<form action="index.php">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last name</th>
            <th>Age</th>
            <th>eMail</th>
            <th>Phone</th>
            <th>Git Address</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $pageType = 'students';
//        updateStudent();
        $students = getStudents();
        $totalPageCount = ceil(count($students) / ITEMS_PER_PAGE);
        if ($currentPage > $totalPageCount) $currentPage--;

        $start = ($currentPage - 1) * ITEMS_PER_PAGE;
        $limit = ITEMS_PER_PAGE;
        if($start+$limit > count($students)){
            $limit = count($students) - $start;
        }

        for($i=$start; $i<$start+$limit; $i++){
            echo '<tr><td>'.($i+1).'</td>';
            echo '<td>'.$students[$i]['first_name'].'</td>';
            echo '<td>'.$students[$i]['last_name'].'</td>';
            echo '<td>'.$students[$i]['age'].'</td>';
            echo '<td>'.$students[$i]['phone'].'</td>';
            echo '<td>'.$students[$i]['email'].'</td>';
            echo '<td>'.$students[$i]['git'].'</td>';

            echo ' <td>';
                echo '<a href="index.php?currentPage=' . $currentPage .'&pageType='.$pageType.'&delButton='. $students[$i]['id']. '" class="btn btn-default">Delete Row</a>';
            echo '</td> </tr>';
        }
        ?>

        </tbody>
    </table>
</form>

<?php
include 'pagination.php';
?>