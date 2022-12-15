<?php
/* Smarty version 4.2.1, created on 2022-12-12 20:11:29
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/productMainCategoryOverviewAdmin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63977ce11bf4e1_97237381',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b1eae85f46185878f4bb7eaa4d09e66b4c89923a' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/productMainCategoryOverviewAdmin.tpl',
      1 => 1670872288,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_63977ce11bf4e1_97237381 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h3>ProductData Overview</h3>

<a href="index.php?page=Admin&backend">Home</a><br/>
<a href="index.php?page=CreateProduct&backend">Create New Product</a>
<br/>
<table>
    <tr>
        <th>Category:</th>
        <th>Productname:</th>
        <th></th>
    </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['main']->value, 'p', false, 'k');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
        <tr>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['p']->value;?>

            </td>
            <td>
                <a href="index.php?page=DetailData&productName=<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
&backend"><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</a>
            </td>
            <td>
                <form action="/index.php?page=CategoryData&productName=<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
&backend" method="post">
                    <input type="submit" name="submit" value="Delete"/></form>
            </td>
        </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
