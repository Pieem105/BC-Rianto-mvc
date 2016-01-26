<?php
/* Smarty version 3.1.29, created on 2016-01-26 10:42:18
  from "C:\xampp\htdocs\bcrianto-mvc\smarty\templates\ledenbekijken.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56a73f7ad2eb79_55622578',
  'file_dependency' => 
  array (
    '9eda4a7845807a2088b7a00b6b6fe1794be60401' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bcrianto-mvc\\smarty\\templates\\ledenbekijken.tpl',
      1 => 1452867408,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:xhtml.tpl' => 1,
    'file:header.tpl' => 1,
    'file:beheerkop.tpl' => 1,
    'file:menu.tpl' => 1,
  ),
),false)) {
function content_56a73f7ad2eb79_55622578 ($_smarty_tpl) {
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:xhtml.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<body>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:beheerkop.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


	<div id="standaard_inhoud_id" class="container-fluid">
		<div class="row">
			<div class="col-sm-12" id="inhoud_id">
				<?php echo $_smarty_tpl->tpl_vars['sHTML']->value;?>

			</div>
		</div>
	</div>
</body>
</html>
<?php }
}
