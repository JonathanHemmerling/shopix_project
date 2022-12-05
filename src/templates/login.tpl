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
            <input type="text" name="userName" value="UserTest123"/>
            <br/>
            Password: <br/>
            <input type="password" name="password" value="password"/>
            <br/><br/>
            <input type="submit" name="submit" value="Login"/>
        </label>
    </form>
</div>
<div class="User">
    <br />
{foreach from=$UserLink item=p}
   {$p}
{/foreach}
</div>
{include file="./loginFooter.tpl"}