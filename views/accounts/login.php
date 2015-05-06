<h1>Login</h1>
<form action="/accounts/login" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username"/>
    <br/>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password"/>
    <br/>
    <input type="submit" value="Login"/>
    <a href="/accounts/register">Go to register</a>
</form>