<?php
    if (!isset($_POST['formToken'])) {
        $_SESSION['formToken'] = uniqid(mt_rand(), true);
    }
?>
<div class="col-lg-5">
    <form action="/questions/create" method="post" class="form-horizontal">
        <fieldset>
            <legend>Create New Question</legend>
            <input type="hidden" name="formToken" value="<?php echo $_SESSION['formToken'] ?>"/>
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
                    <select class="form-control categories" id="question_category" name="question_category">
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="question_tags" class="col-lg-2 control-label">Tags:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="question_tags" name="question_tags">
                </div>
            </div>
            <div class="col-lg-10 col-lg-offset-2">
                <a href="/questions" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>&nbsp;Back to questions</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </fieldset>
</div>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
    $( document ).ready(function() {
        $.ajax({
            url: '/categories/getCategories',
            method: 'GET'
        }).success(function (data) {
            $('.categories').html(data);
        })
    });
</script>