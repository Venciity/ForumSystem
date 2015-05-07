<?php foreach ($this->questionInfo as $info) : ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?= htmlspecialchars($info['text']) ?></h3>
        </div>
        <div class="panel-body"><?= htmlspecialchars($info['content']) ?></div>
        <div class="panel-footer">
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