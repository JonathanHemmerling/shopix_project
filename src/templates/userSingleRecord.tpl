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
<div class="changeUserForm">
    <h3>Userdata</h3>

    <form  action="/index.php?page=UserSingleRecord&userId={$smarty.session.userId}&backend" method="post">
        <label>
            {foreach from=$items key=k item=p}
            {$k}:<br />
        <input type="text" name="{$k}" value="{$p}"/>
        <br/><br/>
            {/foreach}
        <input type="submit" name="submit" value="Submit">
        <br/>
        </label>

    </form>

</div>
<div class="backToLogin">
    <br/>
    <a href="index.php">Home</a>
</div>