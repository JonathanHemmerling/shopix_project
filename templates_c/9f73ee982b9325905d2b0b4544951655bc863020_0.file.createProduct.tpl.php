<?php
/* Smarty version 4.2.1, created on 2022-12-12 14:46:01
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/createProduct.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63973099edf438_23467151',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f73ee982b9325905d2b0b4544951655bc863020' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/createProduct.tpl',
      1 => 1670852756,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_63973099edf438_23467151 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
