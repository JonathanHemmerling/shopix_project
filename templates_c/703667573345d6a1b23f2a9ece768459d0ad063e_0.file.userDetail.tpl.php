<?php
/* Smarty version 4.2.1, created on 2022-12-12 21:18:59
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/userDetail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63978cb3ad74e2_63376764',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '703667573345d6a1b23f2a9ece768459d0ad063e' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/userDetail.tpl',
      1 => 1670876336,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_63978cb3ad74e2_63376764 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h3>Userdata Detail</h3>

<a href="index.php?page=Admin&backend">Home</a>
<br />
<table>
<tr>
    <td><form action="/index.php?page=UserDetail&backend" method="post">
    <label>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['singleUser']->value, 'p', false, 'k');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
        <?php echo $_smarty_tpl->tpl_vars['k']->value;?>
:
    <input type="text" name= "<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
"/>
        <br/>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <input type="submit" name= "submit" value="save"/>
    </label>
    </form>
    </td>
</tr>
</table>

<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
