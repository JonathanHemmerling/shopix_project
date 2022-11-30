{include file="./header.tpl"}
<pre>
{foreach from=$productHome item=p}
{$p}
{/foreach}
{foreach from=$productName item=p}
{$p}
{/foreach}
{foreach from=$productDescription item=p}
{$p}
{/foreach}
{foreach from=$price item=p}
{$p} €
{/foreach}
</pre>
{include file="./footer.tpl"}