
<h3 class="text-center">Posts</h3>
<form action="index.php">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Category Name</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $pageType = 'categories';
        //        updateStudent();
        $data = getData();
        $totalPageCount = ceil(count($data) / ITEMS_PER_PAGE);
        if ($currentPage > $totalPageCount) $currentPage--;

        $start = ($currentPage - 1) * ITEMS_PER_PAGE;
        $limit = ITEMS_PER_PAGE;
        if($start+$limit > count($data)){
            $limit = count($data) - $start;
        }

        for($i=$start; $i<$start+$limit; $i++){
            echo '<tr><td>'.($i+1).'</td>';
            echo '<td>'.$data[$i]['title'].'</td>';

            echo ' <td>';
            echo '<a href="index.php?currentPage=' . $currentPage .'&pageType='.$pageType.'&delButton='. $data[$i]['id']. '" class="btn btn-default">Delete Row</a>';
            echo '</td> </tr>';
        }
        ?>

        </tbody>
    </table>
</form>

<?php
include 'pagination.php';
?>