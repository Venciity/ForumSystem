<h1><?= htmlspecialchars($this->title)?></h1>
<a href="/questions/create" class="btn btn-primary create">Create</a>
<?php foreach ($this->questions as $question) : ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a href="/questions/viewQuestionInfo/<?= htmlspecialchars($question[0]) ?>">
                    <?= htmlspecialchars($question[1]) ?>
                </a>
            </h3>
        </div>
        <div class="panel-footer">
            <button class="btn btn-primary btn-xs" type="button">
                Visits: <span class="badge"><?= $question['3'] ?></span>
            </button>
            <span class="label label-primary">Category: <?= htmlspecialchars($question[4]) ?></span>
            <span class="label label-primary">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <?= htmlspecialchars($question[5]) ?>
            </span>
            <?php if($_SESSION['username'] == $question[5]) : ?>
                <a href="/questions/delete/<?= $question[0] ?>" class="btn btn-danger btn-xs pull-right">Delete</a>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
<nav>
    <ul class="pager">
        <li><a href="/questions/index/<?php if($this->page > 0){
                echo $this->page - 1;
            } else {
                echo $this->page;
            }
        ?>/<?= $this->pageSize ?>" class="btn">Previous</a></li>
        <li><a href="/questions/index/<?= $this->page + 1 ?>/<?= $this->pageSize ?>" class="btn">Next</a></li>
    </ul>
</nav>
<br/><br/><br/><br/>