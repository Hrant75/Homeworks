<!--$data ITEMS_PER_PAGE $currentPage $pageType $fileName-->
<!---->
<!--$totalPageCount = ceil(count($data) / ITEMS_PER_PAGE);-->
<!--if ($currentPage > $totalPageCount) $currentPage--;-->
<!---->
<!--$start = ($currentPage - 1) * ITEMS_PER_PAGE;-->
<!--$limit = ITEMS_PER_PAGE;-->
<!--if($start+$limit > count($data)){-->
<!--$limit = count($data) - $start;-->
<!--}-->
<!---->
<!--for($i=$start; $i<$start+$limit; $i++){-->
<!--echo '<tr><td>'.($i+1).'</td>';-->
<!--    echo '<td>'.$data[$i]['category'].'</td>';-->
<!---->
<!--    echo ' <td>';-->
<!--        echo '<a href="admin.php?currentPage=' . $currentPage .'&pageType='.$pageType.'&delButton='. $data[$i]['id']. '" class="btn btn-default">Delete Row</a>';-->
<!--        echo '</td> </tr>';-->
<!--}-->

<nav class="text-center">
    <ul class="pagination">
        <li>
            <?php
            if ($currentPage < 2){
                echo '<a href="#" style="color:black"';
            }else{
                echo '<a href="'.$fileName.'?currentPage='.($currentPage-1).'&pageType='.$pageType.'" ';
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
            echo '<li class=" '.$class.' "><a href="'.$fileName.'?currentPage=' . $i .'&pageType='.$pageType.' "style="' . $style . '">' . $i . '</a></li>';
        }
        ?>
        <li>
            <?php
            if ($currentPage == $totalPageCount){
                echo '<a href="#" style="color:black"';
            }else{
                echo '<a href="'.$fileName.'?currentPage='.($currentPage+1).'&pageType='.$pageType.'" ';
            }
            ?>aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
