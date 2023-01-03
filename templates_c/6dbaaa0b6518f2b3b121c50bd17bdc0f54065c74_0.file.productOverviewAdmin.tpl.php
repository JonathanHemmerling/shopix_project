<?php
/* Smarty version 4.3.0, created on 2023-01-02 17:52:24
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/productOverviewAdmin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_63b319d80bdbe9_62763589',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6dbaaa0b6518f2b3b121c50bd17bdc0f54065c74' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/productOverviewAdmin.tpl',
      1 => 1672681940,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_63b319d80bdbe9_62763589 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div>

<a href="index.php?page=CreateProduct&backend&mainId=<?php echo $_SESSION['mainId'];?>
">Create New Product</a>
</div>
<br/>
<div>
    <table>
        <tr>
            <th>Products:</th>
            <th></th>
        </tr>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productDataSet']->value, 'p', false, 'k');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
    <tr>
        <td>
<a href="index.php?page=AdminProductSingleRecord&productId=<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
&backend"><?php echo $_smarty_tpl->tpl_vars['p']->value;?>
</a>
    </td>
    <td>
    <form action="/index.php?page=AdminProductOverview&backend&productId=<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
&mainId=<?php echo $_SESSION['mainId'];?>
" method="post">
        <input type="submit" name="submit" value="Delete"/>
    </form>
    </td>
    </tr>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
</div>
<br/>
<div>
<a href="index.php?page=Admin&backend">Home</a>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
