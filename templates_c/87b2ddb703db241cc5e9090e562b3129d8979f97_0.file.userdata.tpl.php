<?php
/* Smarty version 4.2.1, created on 2022-12-08 21:39:10
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/userdata.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63924b6e09c381_52294220',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87b2ddb703db241cc5e9090e562b3129d8979f97' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/userdata.tpl',
      1 => 1670531939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./loginFooter.tpl' => 1,
  ),
),false)) {
function content_63924b6e09c381_52294220 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h3>TestUserData</h3>
<a href="index.php?page=Admin&backend">Home</a>

<?php $_smarty_tpl->_subTemplateRender("file:./loginFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
