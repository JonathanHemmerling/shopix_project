{include file="./header.tpl"}

<h3>ProductData Detail</h3>

<a href="index.php?page=Admin&backend">Home</a>
<br />
<table>
<tr>
    <td><form action="/index.php?page=AdminProductSingleRecord&productId={$smarty.session.productId}&backend" method="post">
    <label>
    {foreach from=$productName key=k item=p}
    <input type="text" name= "{$k}" value="{$p}"/>
    {/foreach}
    <input type="submit" name= "submit" value="save"/>
    </label>
    </form>
    </td>
</tr>
</table>

{include file="./loginFooter.tpl"}