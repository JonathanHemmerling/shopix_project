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

    <form action="/index.php?pageb=Login" method="post">
        Username: <br/>
        <label>
            <input type="text" name="userName" value=""/>
            <br/>
            Password: <br/>
            <input type="password" name="password" value=""/>
            <br/><br/>
            <input type="submit" name="submit" value="Login"/>
        </label>
    </form>
</div>
<div class="newUser">
    <br />
{foreach from=$newUserLink item=p}
   {$p}
{/foreach}
</div>
{include file="./loginFooter.tpl"}