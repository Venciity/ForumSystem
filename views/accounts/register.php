<!--<h1>Register</h1>-->
<!--<form action="/accounts/register" method="post">-->
<!--    <label for="username">Username:</label>-->
<!--    <input type="text" name="username" id="username"/>-->
<!--    <br/>-->
<!--    <label for="password">Password:</label>-->
<!--    <input type="password" name="password" id="password"/>-->
<!--    <br/>-->
<!--    <input type="submit" value="Register"/>-->
<!--    <a href="/accounts/login">Go to login</a>-->
<!--</form>-->

<div class="col-lg-5">
    <form action="/accounts/register" method="post" class="form-horizontal">
        <fieldset>
            <legend>Register</legend>
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
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="/accounts/login" class="btn btn-primary pull-right">Go to login</a>
            </div>
        </fieldset>
</div>
</form>
</div>