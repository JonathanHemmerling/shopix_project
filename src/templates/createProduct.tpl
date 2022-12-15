{include file="./header.tpl"}

<h3>Create new Product</h3>

<a href="index.php?page=Admin&backend">Home</a><br/>
<br/>
<table>
    <tr>
        {foreach from=$mainId item=p}
        <td><form action="/index.php?page=CreateProduct&mainId={$p}&backend" method="post">

         <label>
             Maincategory: <br/>
             {$p}
             <br />
             Displayname: <br/>
             <input type="text" name= "displayName" value=""/>
             <br/>
             Productname: <br/>
             <input type="text" name= "productName" value=""/>
             <br/>
             Description: <br/>
             <input type="text" name= "description" value=""/>
             <br/>
             Price: <br/>
             <input type="text" name= "price" value=""/>
             <br/>
             <br/>
             <input type="submit" name= "submit" value="Save new Product"/>
         </label>

         </form>
        </td>
        {/foreach}
    </tr>
{include file="./loginFooter.tpl"}