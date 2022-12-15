{include file="./header.tpl"}

<div>

<a href="index.php?page=CreateProduct&backend&mainId={$smarty.session.mainId}">Create New Product</a>
</div>
<br/>
<div>
    <table>
        <tr>
            <th>Products:</th>
            <th></th>
        </tr>
{foreach from=$products key=k item=p}
    <tr>
        <td>
<a href="index.php?page=AdminProductSingleRecord&productId={$k}&backend">{$p}</a>
    </td>
    <td>
    <form action="/index.php?page=AdminProductOverview&backend&productId={$k}&mainId={$smarty.session.mainId}" method="post">
        <input type="submit" name="submit" value="Delete"/>
    </form>
    </td>
    </tr>
{/foreach}
</table>
</div>
<br/>
<div>
<a href="index.php?page=Admin&backend">Home</a>
</div>
{include file="./loginFooter.tpl"}