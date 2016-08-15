<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h3>Add Note</h3>
            <form class="form" method="post" action="index.php">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Title</label>
                        <textarea class="form-control"  id="content" name="content" rows="10" required></textarea>
                    </div>

                <button type="submit" class="btn btn-default" name="add">Add</button>
            </form>
        </div>
    </div>
</div>