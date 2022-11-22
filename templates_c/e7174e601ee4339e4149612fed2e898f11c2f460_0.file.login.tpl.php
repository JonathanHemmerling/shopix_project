<?php
/* Smarty version 4.2.1, created on 2022-11-22 15:48:40
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_637ce148817806_77401147',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7174e601ee4339e4149612fed2e898f11c2f460' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/login.tpl',
      1 => 1669128514,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_637ce148817806_77401147 (Smarty_Internal_Template $_smarty_tpl) {
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

    <form action="/index.php?pageb=Login" method="post">
        Username: <br/>
        <label>
            <input type="text" name="userName" value=""/>
            <br/>
            Password: <br/>
            <input type="password" name="password" value=""/>
            <br/><br/>
            <input type="submit" name="submit" value="Login"/>
        </label>
    </form>
</div>
<div class="User">
    <br />
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['UserLink']->value, 'p');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
   <?php echo $_smarty_tpl->tpl_vars['p']->value;?>

<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
