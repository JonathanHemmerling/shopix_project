<?php
/* Smarty version 4.2.1, created on 2022-11-15 14:10:51
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/newUser.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63738fdb8062c0_59350658',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9131a2198db354de2a0123a8a5f01c021681eaf7' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/newUser.tpl',
      1 => 1668517851,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
  ),
),false)) {
function content_63738fdb8062c0_59350658 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="newUser">
    <style type="text/css">
        .error {
            color: red;
        }</style>
    <div class="error">
<pre>
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
</pre>
</div>
<h3>Create new User</h3>
<form action="/index.php" method="get">
<label>
Username: <br />
<input type="text" name="userName" value=""/>
<br/>
<br/>
Password: <br />
<input type="text" name="password" value=""/>
<br />
<br />
Repeat Password: <br />
<input type="text" name="confirmPassword" value=""/>
<br />
<br />
<input type="submit" name="submit" value="Submit">
<br />
</label>
</form>
</div><?php }
}
