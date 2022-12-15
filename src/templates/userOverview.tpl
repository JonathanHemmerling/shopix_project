{include file="./header.tpl"}

<h3>User Overview</h3>

<a href="index.php?page=Admin&backend">Home</a><br/>
<a href="index.php?page=CreateUser&backend">Create New User</a>
<br/>
<table>
    <tr>
        <th>User:</th>
        <th></th>
    </tr>
    {foreach from=$userDisplay key=k item=p}
        <tr>
            <td>
                <a href="index.php?page=UserSingleRecord&userName={$p}&backend">{$p}</a>
            </td>
            <td>
                    <form action="/index.php?page=AdminUserOverview&backend&userId={$k}" method="post"><input type="submit" name="submit" value="Delete"/></form>
            </td>
        </tr>
    {/foreach}
</table>
{include file="./loginFooter.tpl"}