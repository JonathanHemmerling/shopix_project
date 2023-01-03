<?php
/* Smarty version 4.3.0, created on 2023-01-02 16:51:02
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/userOverview.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_63b30b76648154_34199771',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1773231eefee4475aefae1a5ffb621e03673b099' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/userOverview.tpl',
      1 => 1672676503,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_63b30b76648154_34199771 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h3>User Overview</h3>

<a href="index.php?page=Admin&backend">Home</a><br/>
<a href="index.php?page=CreateUser&backend">Create New User</a>
<br/>
<table>
    <tr>
        <th>User:</th>
        <th></th>
    </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['userDisplay']->value, 'p', false, 'k');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
        <tr>
            <td>
                <a href="index.php?page=UserSingleRecord&userName=<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
&backend"><?php echo $_smarty_tpl->tpl_vars['p']->value;?>
</a>
            </td>
            <td>
                    <form action="/index.php?page=AdminUserOverview&backend&userId=<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" method="post"><input type="submit" name="submit" value="Delete"/></form>
            </td>
        </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
