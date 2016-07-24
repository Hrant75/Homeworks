<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" method="post" action="admin.php" enctype="multipart/form-data">
                <?php
                if($pageType=='categories') {
                    echo '
                        <div class="form-group">
                            <label for="updateRow">Row #</label>
                            <input type="number" class="btn btn-warning" min="1" id="updateRow" name="updateRow" oninput="changeValues()" required>
                        </div>
                            <div class="form-group">
                                <label for="updateCategory">Category</label>
                                <input type="text" class="form-control" id="updateCategory" name="updateCategory"  required>
                            </div>';

                } else if($pageType=='news') {
                    echo '
                        <div class="form-group">
                            <label for="updateRow">Row #</label>
                            <input type="number" class="btn btn-warning" min="1" id="updateRow" name="updateRow" oninput="changeValues()" required>
                        </div>
                            <div class="form-group">
                                <label for="updateTitle">Title</label>
                                <input type="text" class="form-control" id="updateTitle" name="updateTitle" required>
                            </div>

                            <div class="form-group">
                                <label for="updateContent">Content</label>
                                <textarea rows="7" class="form-control" id="updateContent" name="updateContent" required></textarea>
                            </div>';
//                           <div class="form-group">
//                                <label for="updateCategory">Category</label>
//                                <input type="text" class="form-control" id="updateCategory" name="updateCategory"  required>
//                            </div>

                    echo '<div class="form-group">
                                     <label for="updateCategory">Category ID</label>
                                     <select  class="form-control"  id="updateCategory"  name="updateCategory" required>';
                    foreach ($categories as $category ){
                        echo '<option value="'.$category['id'].'">'.$category['category'].'</option>';
                    }
                    echo '</select>
                                    </div>';
                }
                echo '
                        <input type="hidden" name="currentPage" value='.$currentPage.'>
                        <button type="submit" id="updateButton" class="btn btn-default" name="update" value='.$pageType.'>Update</button>';
               ?>
            </form>



<!---->
<!--        <div class="form-group">-->
<!--            <label for="first_name">Row #</label>-->
<!--            <input type="number" class="btn btn-warning" min="1" id="updateRow" name="updateRow" oninput="changeValues()" required>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label for="first_name">First Name</label>-->
<!--            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label for="last_name">Last Name</label>-->
<!--            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label for="age">Age</label>-->
<!--            <input type="number" class="form-control" id="age" name="age" placeholder="age">-->
<!--        </div>-->

<!--        <button type="submit" class="btn btn-warning" name="update_student" id="updateBtn">Update Row</button>-->




        </div>
    </div>
</div>


<script type='text/javascript'>
<?php
    $js_news = json_encode($data);
    echo "var js_news = ". $js_news . ";\n";
    ?>
    document.getElementById('updateRow').setAttribute('max', js_news.length);
    function  changeValues() {
        var row = document.getElementById('updateRow').value-1;
        document.getElementById('updateButton').value = js_news[row]['id'];
//        document.getElementById('updateTitle').value = js_news[row]['title'];
//        document.getElementById('updateContent').value = js_news[row]['content'];
        document.getElementById('updateCategory').value = js_news[row]['category'];
    }
//    function  changeCategoryValue() {
//        var row = document.getElementById('updateRow').value-1;
//        document.getElementById('category').value = js_news[row]['category'];
//    }
</script>