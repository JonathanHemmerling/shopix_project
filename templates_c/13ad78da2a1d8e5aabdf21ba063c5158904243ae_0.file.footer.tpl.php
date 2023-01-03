<?php
/* Smarty version 4.3.0, created on 2023-01-02 16:21:50
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_63b3049e390759_11585732',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13ad78da2a1d8e5aabdf21ba063c5158904243ae' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/footer.tpl',
      1 => 1672676503,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63b3049e390759_11585732 (Smarty_Internal_Template $_smarty_tpl) {
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
