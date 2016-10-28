<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" method="post" action="index.php" enctype="multipart/form-data">
                <?php
                if($pageType=='categories') {
                    echo '
                            <div class="form-group">
                                <label for="addCategory">Add Category</label>
                                <input type="text" class="form-control" id="addCategory" name="addCategory" oninput="categoryName()" required>
                            </div>
                            <div class="alert alert-danger categoryNameAlert" role="alert">
                                The category name should be 2-20 characters with
                            </div>';
                } else if($pageType=='posts') {
                    echo '
                            <div class="form-group">
                                <label for="addTitle">Post Title</label>
                                <input type="text" class="form-control" id="addTitle" name="addTitle" required> <!--oninput="checkTitle()"-->  
                            </div>
                            <div class="alert alert-danger titleAlert" role="alert">
                                The name should be 3-200 characters with capital first letter
                            </div>
                            
                            <div class="form-group">
                                <label for="addContent">Last Name</label>
                                <textarea rows="7" class="form-control" id="addContent" name="addContent" required></textarea>
                            </div>';

                    echo '<div class="form-group">
                                     <label for="addAutorID">Author ID</label>
                                     <select  class="form-control"  id="addAutorID"  name="addAutorID" required>';
                    foreach ($authors as $author ){
                        echo '<option value="'.$author['id'].'">'.$author['name'].'</option>';
                    }
                    echo '</select>
                                    </div>
                                    
                     <input type="file" name="uploadFile" accept="image/*">';
                } else if($pageType=='authors') {
                    echo '
                            <div class="form-group">
                                <label for="addAuthor">Add Author</label>
                                <input type="text" class="form-control" id="addAuthor" name="addAuthor" oninput="authorName()" required>
                            </div>
                            <div class="alert alert-danger authorNameAlert" role="alert">
                                The author name should be 2-50 characters
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