{include file="./header.tpl"}
<pre>
{foreach from=$categoryHome item=q}
    {$q}
{/foreach}
{foreach from=$categoryLink item=p}
    <a href={$p}</a>
{/foreach}
</pre>
{include file="./footer.tpl"}