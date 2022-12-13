<?php
/* Smarty version 4.2.1, created on 2022-12-08 21:27:15
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_639248a388c359_26776785',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13ad78da2a1d8e5aabdf21ba063c5158904243ae' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/footer.tpl',
      1 => 1670531233,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639248a388c359_26776785 (Smarty_Internal_Template $_smarty_tpl) {
?><div>
    <form action="/index.php?page=Logout&backend" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</div>
<div>
    <br />
    <a href="index.php?page=ChangeUserData&backend">Change Userdata</a>
</div>
</body>
</html><?php }
}
