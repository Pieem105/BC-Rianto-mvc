<?php
/* Smarty version 3.1.29, created on 2016-01-11 16:31:09
  from "C:\xampp\htdocs\bcrianto-mvc\smarty\templates\header.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5693cabda1ce17_73217132',
  'file_dependency' => 
  array (
    '2f7675125a2800975f5c5b64a909896b63f9a7bd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bcrianto-mvc\\smarty\\templates\\header.tpl',
      1 => 1452525945,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5693cabda1ce17_73217132 ($_smarty_tpl) {
?>

<head>
	<title><?php echo $_smarty_tpl->tpl_vars['sTitel']->value;?>
</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/rianto.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.bcrianto.min.css">
	<link rel="stylesheet" type="text/css" href="css/complete-boek.css" />
	<?php echo '<script'; ?>
 src="../js/jquery.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="../js/bootstrap.min.js"><?php echo '</script'; ?>
>
	<meta   name="description" content="Op deze website vindt u informatie over BC Rianto, de badmintonclub van Zutphen">
	<meta   name="Keywords" content="badminton; zutphen; badmintonvereniging rianto; badmintonclub; bc rianto">
	<?php if ((isset($_smarty_tpl->tpl_vars['aScripts']->value) && (count($_smarty_tpl->tpl_vars['aScripts']->value) > 0))) {?>
	<?php
$_from = $_smarty_tpl->tpl_vars['aScripts']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_sScriptFile_0_saved_item = isset($_smarty_tpl->tpl_vars['sScriptFile']) ? $_smarty_tpl->tpl_vars['sScriptFile'] : false;
$_smarty_tpl->tpl_vars['sScriptFile'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['sScriptFile']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['sScriptFile']->value) {
$_smarty_tpl->tpl_vars['sScriptFile']->_loop = true;
$__foreach_sScriptFile_0_saved_local_item = $_smarty_tpl->tpl_vars['sScriptFile'];
?>
	<?php echo '<script'; ?>
 type="text/javascript" language="javascript" src="<?php echo $_smarty_tpl->tpl_vars['sScriptFile']->value;?>
"><?php echo '</script'; ?>
>
	<?php
$_smarty_tpl->tpl_vars['sScriptFile'] = $__foreach_sScriptFile_0_saved_local_item;
}
if ($__foreach_sScriptFile_0_saved_item) {
$_smarty_tpl->tpl_vars['sScriptFile'] = $__foreach_sScriptFile_0_saved_item;
}
?>
	<?php }?>
</head><?php }
}
