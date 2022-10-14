{include file="./header.tpl"}
<pre>
{$home}
{foreach from=$menu item=p}
    - <a href={$p}</a>
{/foreach}
{foreach from=$name item=c}
    {$c}
{/foreach}
{foreach from=$description item=d}
    {$d}
 {/foreach}
</pre>
{include file="./footer.tpl"}