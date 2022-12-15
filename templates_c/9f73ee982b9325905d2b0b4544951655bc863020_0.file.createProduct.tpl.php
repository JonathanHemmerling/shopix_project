<?php
/* Smarty version 4.2.1, created on 2022-12-15 15:52:23
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/createProduct.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_639b34a7ef3d41_07348397',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f73ee982b9325905d2b0b4544951655bc863020' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/createProduct.tpl',
      1 => 1671115942,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_639b34a7ef3d41_07348397 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h3>Create new Product</h3>

<a href="index.php?page=Admin&backend">Home</a><br/>
<br/>
<table>
    <tr>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mainId']->value, 'p');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
        <td><form action="/index.php?page=CreateProduct&mainId=<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
&backend" method="post">

         <label>
             Maincategory: <br/>
             <?php echo $_smarty_tpl->tpl_vars['p']->value;?>

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
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tr>
<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
