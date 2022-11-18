{include file="./header.tpl"}
    <style type="text/css">{literal}
        .error {
            color: blue;
            font-size: large;
            font-weight: bolder;
        }{/literal}</style>
    <div class="error">
<pre>
{foreach from=$errors item=p}
    {$p}
{/foreach}
</pre>
</div>
<div class="newUserForm">
<h3>Create new User</h3>
<form action="/index.php?newUser" method="post">
<label>
Username: <br />
<input type="text" name="userName" value=""/>
<br/>
<br/>
Password: <br />
<input type="password" name="password" value=""/>
<br />
<br />
Repeat Password: <br />
<input type="password" name="confirmPassword" value=""/>
<br />
<br />
<input type="submit" name="submit" value="Submit">
<br />
</label>
</form>
</div>
<div class="backToLogin">
    <br />
    {foreach from=$backToLogin item=q}
        {$q}
    {/foreach}
</div>