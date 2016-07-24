<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" method="post" action="admin.php" enctype="multipart/form-data">
                <?php
                if($pageType=='categories') {
                    echo '
                            <div class="form-group">
                                <label for="addCategory">Add Category</label>
                                <input type="text" class="form-control" id="addCategory" name="addCategory"  required>
                            </div>';
                } else if($pageType=='news') {
                    echo '
                            <div class="form-group">
                                <label for="addTitle">Title</label>
                                <input type="text" class="form-control" id="addTitle" name="addTitle" required>
                            </div>

                            <div class="form-group">
                                <label for="addContent">Content</label>
                                <textarea rows="7" class="form-control" id="addContent" name="addContent" required></textarea>
                            </div>';

                        echo '<div class="form-group">
                                         <label for="addCategoryID">Category ID</label>
                                         <select  class="form-control"  id="addCategoryID"  name="addCategoryID" required>';
                        foreach ($allCategories as $category ){
                            echo '<option value="'.$category->getId().'">'.$category->getCategory().'</option>';
                        }
                        echo '</select>
                                        </div>';
                }
                echo '
                        <input type="hidden" name="currentPage" value='.$currentPage.'>
                        <button type="submit" id="addButton" class="btn btn-default" name="add" value='.$pageType.'>Add</button>';
                ?>
            </form>
        </div>
    </div>
</div>