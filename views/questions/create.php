<div class="col-lg-5">
    <form action="/questions/create" method="post" class="form-horizontal">
        <fieldset>
            <legend>Create New Question</legend>
            <div class="form-group">
                <label for="question_text" class="col-lg-2 control-label">Text:</label>
                <div class="col-lg-10">
                    <textarea class="form-control" rows="2" id="question_text" name="question_text"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="question_content" class="col-lg-2 control-label">Content:</label>
                <div class="col-lg-10">
                    <textarea class="form-control" rows="3" id="question_content" name="question_content"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="question_category" class="col-lg-2 control-label">Category:</label>
                <div class="col-lg-10">
                    <select class="form-control" id="question_category" name="question_category">
                        <?php foreach ($this->categories as $category) : ?>
                        <option><?= htmlspecialchars($category['text']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="/questions" class="btn btn-primary pull-right">Back to questions</a>
            </div>
        </fieldset>
</div>