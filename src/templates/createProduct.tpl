{include file="./header.tpl"}

<h3>Create new Product</h3>

<a href="index.php?page=Admin&backend">Home</a><br/>
<br/>
<table>
    <tr>
        <td><form action="/index.php?page=CreateProduct&backend" method="post">
         <label>
             Maincategory: <br/>
             <select name="mainId" size = "3">
             <option>1</option>
             <option>2</option>
             <option>3</option>
             </select>
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
    </tr>
{include file="./loginFooter.tpl"}