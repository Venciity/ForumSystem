<!--<h1>Login</h1>-->
<!--<form action="/accounts/login" method="post">-->
<!--    <label for="username">Username:</label>-->
<!--    <input type="text" name="username" id="username"/>-->
<!--    <br/>-->
<!--    <label for="password">Password:</label>-->
<!--    <input type="password" name="password" id="password"/>-->
<!--    <br/>-->
<!--    <input type="submit" value="Login"/>-->
<!--    <a href="/accounts/register">Go to register</a>-->
<!--</form>-->
<div class="col-lg-5">
    <form action="/accounts/login" method="post" class="form-horizontal">
        <fieldset>
            <legend>Login</legend>
            <div class="form-group">
                <label for="username" class="col-lg-2 control-label">Username</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="username" name="username">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-lg-2 control-label">Password</label>
                <div class="col-lg-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="/accounts/register" class="btn btn-primary pull-right">Go to registration</a>
            </div>
        </fieldset>
</div>
</form>
</div>