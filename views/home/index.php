<h1><?= htmlspecialchars($this->title)?></h1>
<?php if(!$this->isLoggedIn) : ?>
<a href="/accounts/login" class="btn btn-default">Login</a>
<?php endif; ?>
<a href="/accounts/register" class="btn btn-default">Register</a>
