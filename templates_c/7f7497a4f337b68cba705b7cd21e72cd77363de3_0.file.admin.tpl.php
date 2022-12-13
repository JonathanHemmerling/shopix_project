<?php
/* Smarty version 4.2.1, created on 2022-12-12 20:46:48
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63978528855779_28497968',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f7497a4f337b68cba705b7cd21e72cd77363de3' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/admin.tpl',
      1 => 1670874406,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_63978528855779_28497968 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h3>Change Data for:</h3>
<div>
<a href="index.php?page=CategoryData&backend">- Productdata</a>
<br />
<a href="index.php?page=UserOverview&backend">- Userdata</a>
</div>
<br />
<div>
    <form action="/index.php?page=AdminLogout&backend" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</div>


<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
