
    <h3 class="text-center">News</h3>
    <form action="admin.php">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Date Created</th>
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $pageType = 'news';
            $data = $newsModel->getData($currentCategory);
            $allCategories = $categoryModel->getCategories();
            echo '<br>';
            $totalPageCount = ceil(count($data) / ITEMS_PER_PAGE);
            if ($currentPage > $totalPageCount) $currentPage--;

            $start = ($currentPage - 1) * ITEMS_PER_PAGE;
            $limit = ITEMS_PER_PAGE;
            if($start+$limit > count($data)){
                $limit = count($data) - $start;
            }
            
            for($i=$start; $i<$start+$limit; $i++){
                echo '<tr><td>'.($i+1).'</td>';
                echo '<td>'.$data[$i]->getDate().'</td>';
                echo '<td>'.$data[$i]->getTitle().'</td>';
                echo '<td>'.$data[$i]->getContent().'</td>';
                echo '<td>'.$data[$i]->getCategory().'</td>';

                echo ' <td>';
                echo '<a href="admin.php?currentPage=' . $currentPage .'&pageType='.$pageType.'&delButton='. $data[$i]->getId(). '" class="btn btn-default">Delete</a>';
                echo '</td> </tr>';
            }
            ?>

            </tbody>
        </table>
    </form>

<?php
include 'pagination.php';
?>