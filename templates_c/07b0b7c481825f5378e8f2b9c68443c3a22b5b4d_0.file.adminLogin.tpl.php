<?php
/* Smarty version 4.2.1, created on 2022-12-08 21:29:15
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/adminLogin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6392491bc79ef4_30318632',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '07b0b7c481825f5378e8f2b9c68443c3a22b5b4d' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/adminLogin.tpl',
      1 => 1670531352,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_6392491bc79ef4_30318632 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h3>Change Data for:</h3>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'p');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
    <?php echo $_smarty_tpl->tpl_vars['p']->value;?>

<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
<div class="loginform">
    <h3>Log in</h3>

    <form action="/index.php?page=AdminLogin&backend" method="post">
        Username: <br/>
        <label>
            <input type="text" name="adminName" value="admin"/>
            <br/>
            Password: <br/>
            <input type="password" name="password" value="adminpassword"/>
            <br/><br/>
            <input type="submit" name="submit" value="Login"/>
        </label>
    </form>
</div>

<a href="index.php">Back</a>

<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
