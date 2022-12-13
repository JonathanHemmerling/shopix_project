{include file="./header.tpl"}

<h3>Change Data for:</h3>
<div>
<a href="index.php?page=CategoryData&backend">- Productdata</a>
<br />
<a href="index.php?page=UserOverview&backend">- Userdata</a>
</div>
<br />
<div>
    <form action="/index.php?page=AdminLogout&backend" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</div>


{include file="./loginFooter.tpl"}