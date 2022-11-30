<?php
/* Smarty version 4.2.1, created on 2022-11-29 13:46:41
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6385ff31bd4c65_82375606',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13ad78da2a1d8e5aabdf21ba063c5158904243ae' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/footer.tpl',
      1 => 1669726001,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6385ff31bd4c65_82375606 (Smarty_Internal_Template $_smarty_tpl) {
?><div>
    <form action="/index.php?pageb=Logout" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</div>
<div>
    <br />
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['changeUserData']->value, 'p');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
    <?php echo $_smarty_tpl->tpl_vars['p']->value;?>

    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
</body>
</html><?php }
}
