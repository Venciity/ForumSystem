<h1><?= htmlspecialchars($this->title)?></h1>
<?php foreach ($this->categories as $category) : ?>
    <a href="/categories/getQuestionsByCategory/<?= $category['text'] ?>" . <?php ?>" class="btn btn-primary"><?= $category['text'] ?></a>
<?php endforeach; ?>