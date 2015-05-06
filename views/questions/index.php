<h1><?= htmlspecialchars($this->title)?></h1>
<div class="panel panel-default">
    <div class="panel-heading">All questions</div>
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Category</th>
            <th>User</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->questions as $question) : ?>
            <tr>
                <td><?= $question['id'] ?></td>
                <td><?= htmlspecialchars($question['text']) ?></td>
                <td><?= htmlspecialchars($question['category']) ?></td>
                <td><?= htmlspecialchars($question['user']) ?></td>
                <td><a href="/questions/delete/<?= $question['id'] ?>">[Delete]</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<a href="/questions/create" class="btn btn-primary">Create</a>