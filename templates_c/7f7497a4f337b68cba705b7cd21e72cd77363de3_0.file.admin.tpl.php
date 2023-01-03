<?php
/* Smarty version 4.3.0, created on 2023-01-02 16:51:00
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_63b30b74c46400_14406083',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f7497a4f337b68cba705b7cd21e72cd77363de3' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/admin.tpl',
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
function content_63b30b74c46400_14406083 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h3>Change Data for:</h3>
<div>
<a href="index.php?page=AdminMainProductCategoryOverview&backend">- Productdata</a>
<br />
<a href="index.php?page=AdminUserOverview&backend">- Userdata</a>
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
