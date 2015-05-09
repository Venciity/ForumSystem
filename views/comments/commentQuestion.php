<div class="col-lg-5">
    <form action="/comments/commentQuestion/<?= $_SESSION['commentId'] ?>" method="post" class="form-horizontal">
        <fieldset>
            <legend>Create New Answer</legend>
            <div class="form-group">
                <label for="comment_content" class="col-lg-2 control-label">Content:</label>
                <div class="col-lg-10">
                    <textarea class="form-control" rows="3" id="comment_content" name="comment_content"></textarea>
                </div>
            </div>
            <div class="col-lg-10 col-lg-offset-2">
                <a href="/questions" class="btn btn-primary">Back to questions</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </fieldset>
</div>