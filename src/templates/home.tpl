{include file="./header.tpl"}
<pre>
{foreach from=$menu item=p}
    <a href={$p}</a>
{/foreach}
</pre>
{include file="./footer.tpl"}