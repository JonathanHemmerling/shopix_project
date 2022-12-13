{include file="./header.tpl"}

<h3>ProductData Overview</h3>

<a href="index.php?page=Admin&backend">Home</a><br/>
<a href="index.php?page=CreateProduct&backend">Create New Product</a>
<br/>
<table>
    <tr>
        <th>Category:</th>
        <th>Productname:</th>
        <th></th>
    </tr>
    {foreach from=$main key=k item=p}
        <tr>
            <td>
                {$p}
            </td>
            <td>
                <a href="index.php?page=DetailData&productName={$k}&backend">{$k}</a>
            </td>
            <td>
                <form action="/index.php?page=CategoryData&productName={$k}&backend" method="post">
                    <input type="submit" name="submit" value="Delete"/></form>
            </td>
        </tr>
    {/foreach}
</table>
{include file="./loginFooter.tpl"}