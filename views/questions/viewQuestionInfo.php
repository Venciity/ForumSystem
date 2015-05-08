<?php foreach ($this->questionInfo as $info) : ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?= htmlspecialchars($info['text']) ?></h3>
        </div>
        <div class="panel-body"><?= htmlspecialchars($info['content']) ?></div>
        <div class="panel-footer">
            <button class="btn btn-primary btn-xs" type="button">
                Visits: <span class="badge"><?= $info['visits_count'] ?></span>
            </button>
            <span class="label label-primary">Category: <?= htmlspecialchars($info['category']) ?></span>
            <span class="label label-primary">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <?= htmlspecialchars($info['user']) ?>
            </span>
            <?php if($_SESSION['username'] == $info['user']) : ?>
                <a href="/questions/delete/<?= $info['id'] ?>" class="btn btn-danger btn-xs pull-right">Delete</a>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
<a href="/comments/commentQuestion/<?= $info['id'] ?>" class="btn btn-primary answer">Answer</a>

<?php foreach ($this->comments as $comment) : ?>
    <div class="panel panel-primary">
        <div class="panel-heading"></div>
        <div class="panel-body"><?= htmlspecialchars($comment['text']) ?></div>
        <div class="panel-footer">
            <span class="label label-primary">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <?= htmlspecialchars($comment['user']) ?>
            </span>
            <?php if($_SESSION['username'] == $comment['user']) : ?>
                <a href="/comments/delete/<?= $comment['id'] ?>" class="btn btn-danger btn-xs pull-right">Delete</a>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>