<?php
/* Smarty version 4.2.1, created on 2022-12-14 09:42:20
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63998c6c6d5c80_97713001',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13ad78da2a1d8e5aabdf21ba063c5158904243ae' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/footer.tpl',
      1 => 1671007337,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63998c6c6d5c80_97713001 (Smarty_Internal_Template $_smarty_tpl) {
?><div>
    <form action="/index.php?page=Logout&backend" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</div>
<div>
    <br />
    <a href="index.php?page=UserSingleRecord&backend">Change Userdata</a>
</div>
</body>
</html><?php }
}
