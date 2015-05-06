<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/content/bootstrap-3.3.4-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/content/styles.css"/>
    <title><?php if(isset($this->title)) echo htmlspecialchars($this->title)?></title>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Forum</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/questions">Questions</a></li>
                <li><a href="#">Categories</a></li>

            </ul>
            <?php if($this->isLoggedIn) : ?>
            <div id="loggedInInfo">
                <form class="navbar-form navbar-right" action="/accounts/logout">
                    <button type="submit" class="btn btn-default">Logout</button>
                </form>
                <span id="greetings">Hello, <?php echo $_SESSION['username']; ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container center-block">
<?php include('messages.php'); ?>