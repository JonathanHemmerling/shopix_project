<?php
/* Smarty version 4.2.1, created on 2022-11-17 13:15:34
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/newUser.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_637625e6c0f249_48647732',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9131a2198db354de2a0123a8a5f01c021681eaf7' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/newUser.tpl',
      1 => 1668687314,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
  ),
),false)) {
function content_637625e6c0f249_48647732 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <style type="text/css">
        .error {
            color: blue;
            font-size: large;
            font-weight: bolder;
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
<div class="newUserForm">
<h3>Create new User</h3>
<form action="/index.php?newUser" method="post">
<label>
Username: <br />
<input type="text" name="userName" value=""/>
<br/>
<br/>
Password: <br />
<input type="password" name="password" value=""/>
<br />
<br />
Repeat Password: <br />
<input type="password" name="confirmPassword" value=""/>
<br />
<br />
<input type="submit" name="submit" value="Submit">
<br />
</label>
</form>
</div>
<div class="backToLogin">
    <br />
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['backToLogin']->value, 'q');
$_smarty_tpl->tpl_vars['q']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['q']->value) {
$_smarty_tpl->tpl_vars['q']->do_else = false;
?>
        <?php echo $_smarty_tpl->tpl_vars['q']->value;?>

    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div><?php }
}
