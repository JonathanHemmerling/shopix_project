<?php
/* Smarty version 4.2.1, created on 2022-12-15 08:24:37
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/createUser.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_639acbb56ee750_01401958',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ea8045732df89206cfd5c241f7758aa9176a871' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/createUser.tpl',
      1 => 1671089067,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
  ),
),false)) {
function content_639acbb56ee750_01401958 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="newUserForm">
<h3>Register User</h3>
<form action="/index.php?page=CreateUser&backend" method="post">
<label>
Username: <br />
<input type="text" name="userName" value=""/>
<br/>
<br/>
    First Name: <br />
    <input type="text" name="firstName" value=""/>
    <br/>
    <br/>
    Last Name: <br />
    <input type="text" name="lastName" value=""/>
    <br/>
    <br/>
    Country: <br />
    <input type="text" name="country" value=""/>
    <br/>
    <br/>
    Postcode: <br />
    <input type="text" name="postCode" value=""/>
    <br/>
    <br/>
    City: <br />
    <input type="text" name="city" value=""/>
    <br/>
    <br/>
    Street: <br />
    <input type="text" name="street" value=""/>
    <br/>
    <br/>
    Streetnumber: <br />
    <input type="text" name="streetNumber" value=""/>
    <br/>
    <br/>
    E-Mailadress: <br />
    <input type="text" name="email" value=""/>
    <br/>
    <br/>
    Telefonnumber: <br />
    <input type="text" name="telefonNumber" value=""/>
    <br/>
    <br/>
Password: <br />
<input type="password" name="password" value=""/>
<br />
<br />
Repeat Password: <br />
<input type="password" name="confirmPassword" value=""/>
<br />
<br />
<input type="submit" name="submit" value="Submit">
<br />
</label>
</form>
</div>
<div class="backToLogin">
    <br />
    <a href="index.php">Back to Login</a>
</div><?php }
}
