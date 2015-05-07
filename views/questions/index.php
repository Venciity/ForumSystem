<h1><?= htmlspecialchars($this->title)?></h1>
<a href="/questions/create" class="btn btn-primary create">Create</a>
<?php foreach ($this->questions as $question) : ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a href="/questions/viewQuestionInfo/<?= htmlspecialchars($question['id']) ?>">
                    <?= htmlspecialchars($question['text']) ?>
                </a>
            </h3>
        </div>
        <div class="panel-footer">
            <span class="label label-primary">Category: <?= htmlspecialchars($question['category']) ?></span>
            <span class="label label-primary">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <?= htmlspecialchars($question['user']) ?>
            </span>
            <?php if($_SESSION['username'] == $question['user']) : ?>
            <a href="/questions/delete/<?= $question['id'] ?>" class="btn btn-danger btn-xs pull-right">Delete</a>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>