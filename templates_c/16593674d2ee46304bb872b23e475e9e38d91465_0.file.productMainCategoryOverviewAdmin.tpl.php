<?php
/* Smarty version 4.3.0, created on 2023-01-02 17:51:32
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/productMainCategoryOverviewAdmin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_63b319a440cb11_73792192',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16593674d2ee46304bb872b23e475e9e38d91465' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/productMainCategoryOverviewAdmin.tpl',
      1 => 1672681891,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_63b319a440cb11_73792192 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div>
    <h3>Main Categorys: </h3>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mainCategory']->value, 'p', false, 'k');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
<a href="index.php?page=AdminProductOverview&mainId=<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
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
