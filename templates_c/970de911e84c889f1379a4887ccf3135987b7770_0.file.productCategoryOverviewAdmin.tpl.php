<?php
/* Smarty version 4.2.1, created on 2022-12-15 14:39:48
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/productMainCategoryOverviewAdmin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_639b23a4239534_58639355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '970de911e84c889f1379a4887ccf3135987b7770' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/productMainCategoryOverviewAdmin.tpl',
      1 => 1671111586,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_639b23a4239534_58639355 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h2>ProductData Category Overview</h2>
<div>

<a href="index.php?page=CreateProduct&backend">Create New Product</a>
</div>
<div>
    <h3>Main Categorys: </h3>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mainCategorys']->value, 'p', false, 'k');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
<a href="index.php?page=AdminProductSingleRecord&mainId=<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
&backend"><?php echo $_smarty_tpl->tpl_vars['p']->value;?>
</a>
<br />
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
<br/>
<div>
<a href="index.php?page=Admin&backend">Home</a>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
