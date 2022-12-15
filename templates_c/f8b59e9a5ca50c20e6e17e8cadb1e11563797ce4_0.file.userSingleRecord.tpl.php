<?php
/* Smarty version 4.2.1, created on 2022-12-14 10:59:21
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/userSingleRecord.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63999e79064a88_08832085',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8b59e9a5ca50c20e6e17e8cadb1e11563797ce4' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/userSingleRecord.tpl',
      1 => 1671011675,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
  ),
),false)) {
function content_63999e79064a88_08832085 (Smarty_Internal_Template $_smarty_tpl) {
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
    <h3>Userdata</h3>

    <form  action="/index.php?page=UserSingleRecord&userId=<?php echo $_SESSION['userId'];?>
&backend" method="post">
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
