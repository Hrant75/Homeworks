<nav class="text-center">
    <ul class="pagination">
        <li>
            <?php
            if ($currentPage < 2){
                echo '<a href="#" style="color:black"';
            }else{
                echo '<a href="index.php?currentPage='.($currentPage-1).'&pageType='.$pageType.'" ';
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
            echo '<li class=" '.$class.' "><a href="index.php?currentPage=' . $i .'&pageType='.$pageType.' "style="' . $style . '">' . $i . '</a></li>';
        }
        ?>
        <li>
            <?php
            if ($currentPage == $totalPageCount){
                echo '<a href="#" style="color:black"';
            }else{
                echo '<a href="index.php?currentPage='.($currentPage+1).'&pageType='.$pageType.'" ';
            }
            ?>aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>