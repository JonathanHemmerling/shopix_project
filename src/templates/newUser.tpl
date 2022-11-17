{include file="./header.tpl"}
<div class="newUser">
    <style type="text/css">{literal}
        .error {
            color: red;
        }{/literal}</style>
    <div class="error">
<pre>
{foreach from=$errors item=p}
    {$p}
{/foreach}
</pre>
</div>
<h3>Create new User</h3>
<form action="/index.php" method="get">
<label>
Username: <br />
<input type="text" name="userName" value=""/>
<br/>
<br/>
Password: <br />
<input type="text" name="password" value=""/>
<br />
<br />
Repeat Password: <br />
<input type="text" name="confirmPassword" value=""/>
<br />
<br />
<input type="submit" name="submit" value="Submit">
<br />
</label>
</form>
</div>