{include file="./header.tpl"}

<h3>Userdata Detail</h3>

<a href="index.php?page=Admin&backend">Home</a>
<br />
<table>
<tr>
    <td><form action="/index.php?page=UserDetail&backend" method="post">
    <label>
    {foreach from=$singleUser key=k item=p}
        {$k}:
    <input type="text" name= "{$k}" value="{$p}"/>
        <br/>
    {/foreach}
    <input type="submit" name= "submit" value="save"/>
    </label>
    </form>
    </td>
</tr>
</table>

{include file="./loginFooter.tpl"}