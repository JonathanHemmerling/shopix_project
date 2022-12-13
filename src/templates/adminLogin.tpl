{include file="./header.tpl"}

<h3>Change Data for:</h3>
{foreach from=$errors item=p}
    {$p}
{/foreach}
<div class="loginform">
    <h3>Log in</h3>

    <form action="/index.php?page=AdminLogin&backend" method="post">
        Username: <br/>
        <label>
            <input type="text" name="adminName" value="admin"/>
            <br/>
            Password: <br/>
            <input type="password" name="password" value="adminpassword"/>
            <br/><br/>
            <input type="submit" name="submit" value="Login"/>
        </label>
    </form>
</div>

<a href="index.php">Back</a>

{include file="./loginFooter.tpl"}