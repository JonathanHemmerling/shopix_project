{include file="./header.tpl"}
<pre>
<a href="index.php">Home</a>
{foreach from=$categoryLink key=k item=p}
<a href="index.php?page=UserProductSingleRecord&productId={$k}">{$p}</a>
{/foreach}
</pre>
{include file="./footer.tpl"}