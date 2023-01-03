<?php
/* Smarty version 4.3.0, created on 2022-12-29 12:50:37
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_63ad8d1d651772_89645752',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7174e601ee4339e4149612fed2e898f11c2f460' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/login.tpl',
      1 => 1671088948,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_63ad8d1d651772_89645752 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<style type="text/css">
    .error {
        color: red;
        font-size: large;
    }</style>
<div class="error">
<pre>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'p');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
echo $_smarty_tpl->tpl_vars['p']->value;?>

<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</pre>
</div>
<div class="loginform">
    <h3>Log in</h3>

    <form action="/index.php?page=Login&backend" method="post">
        Username: <br/>
        <label>
            <input type="text" name="userName" value="UserTest123"/>
            <br/>
            Password: <br/>
            <input type="password" name="password" value="password"/>
            <br/><br/>
            <input type="submit" name="submit" value="Login"/>
        </label>
    </form>
</div>
<div><a href="index.php?page=CreateUser&backend">Register user</a></div>

<div><br />
    <a href="index.php?page=AdminLogin&backend">Adminarea</a>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
