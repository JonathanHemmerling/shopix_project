<?php
/* Smarty version 4.2.1, created on 2022-12-06 14:46:44
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/categorydata.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_638f47c4242768_52315250',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc18fddeea059cfba19f3c8a6549849ac0f7ad7e' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/categorydata.tpl',
      1 => 1670334402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_638f47c4242768_52315250 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h3>TestProductData</h3>

<a href="index.php?pageb=Admin">Home</a>
<br />
<table>
 <tr>
 <th>Category:</th>
 <th>Productname:</th>
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
        <a href="test" <?php echo $_smarty_tpl->tpl_vars['k']->value;?>
><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</a>
    </td>
    </tr>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>






</table>

<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
