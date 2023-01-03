{include file="./header.tpl"}

<div>
    <h3>Main Categorys: </h3>
{foreach from=$mainCategory key=k item=p}
<a href="index.php?page=AdminProductOverview&mainId={$k}&backend">{$p}</a>
<br />
{/foreach}
</div>
<br/>
<div>
<a href="index.php?page=Admin&backend">Home</a>
</div>
{include file="./loginFooter.tpl"}