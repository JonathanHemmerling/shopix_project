{include file="./header.tpl"}
<style type="text/css">{literal}
    .error {
        color: red;
        font-size: large;
    }{/literal}</style>
<div class="error">
<pre>
{foreach from=$errors item=p}
{$p}
{/foreach}
</pre>
</div>
<div class="loginform">
    <h3>Log in</h3>

    <form action="/index.php?page=Login&backend" method="post">
        Username: <br/>
        <label>
            <input type="text" name="userName" value="UserTest123"/>
            <br/>
            Password: <br/>
            <input type="password" name="password" value="password"/>
            <br/><br/>
            <input type="submit" name="submit" value="Login"/>
        </label>
    </form>
</div>
<div><a href="index.php?page=User&backend">Register as new user</a></div>

<div><br />
    <a href="index.php?page=AdminLogin&backend">Adminarea</a>
</div>
{include file="./loginFooter.tpl"}