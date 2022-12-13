<?php
/* Smarty version 4.2.1, created on 2022-12-12 08:05:38
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/changeUserData.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6396d2c28dac32_65126164',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a46d4c2b024b00ecb6853d611c09bac07e56b793' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/changeUserData.tpl',
      1 => 1670595519,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
  ),
),false)) {
function content_6396d2c28dac32_65126164 (Smarty_Internal_Template $_smarty_tpl) {
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
?>
    <?php echo $_smarty_tpl->tpl_vars['p']->value;?>

<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</pre>
</div>
<div class="changeUserForm">
    <h3>Change Userdata</h3>
    <form action="/index.php?page=ChangeUserData&backend" method="post">
        <label>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'p', false, 'k');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
            <?php echo $_smarty_tpl->tpl_vars['k']->value;?>
:<br />
        <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
"/>
        <br/><br/>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <input type="submit" name="submit" value="Submit">
        <br/>
        </label>
    </form>
</div>
<div class="backToLogin">
    <br/>
    <a href="index.php">Home</a>
</div><?php }
}
