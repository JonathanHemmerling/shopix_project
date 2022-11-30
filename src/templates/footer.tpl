<div>
    <form action="/index.php?pageb=Logout" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</div>
<div>
    <br />
    {foreach from=$changeUserData item=p}
    {$p}
    {/foreach}
</div>
</body>
</html>