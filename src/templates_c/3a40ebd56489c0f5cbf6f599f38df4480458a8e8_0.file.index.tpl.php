<?php
/* Smarty version 4.2.1, created on 2022-10-13 11:44:52
  from '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6347de14ee4925_98377725',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a40ebd56489c0f5cbf6f599f38df4480458a8e8' => 
    array (
      0 => '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/templates/index.tpl',
      1 => 1665654291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6347de14ee4925_98377725 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/jonathanhemmerling/PhpstormProjects/shopix_project/vendor/smarty/smarty/libs/plugins/modifier.capitalize.php','function'=>'smarty_modifier_capitalize',),1=>array('file'=>'/home/jonathanhemmerling/PhpstormProjects/shopix_project/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<html>
<head>
    <title>Info</title>
</head>
<body>

<pre>
User Information:

Name: <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['name']->value);?>

Address: <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value, ENT_QUOTES, 'UTF-8', true);?>

Date: <?php echo smarty_modifier_date_format(time(),"%b %e, %Y");?>

</pre>

</body>
</html><?php }
}
