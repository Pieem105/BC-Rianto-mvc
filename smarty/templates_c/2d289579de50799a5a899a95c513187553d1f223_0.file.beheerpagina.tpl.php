<?php
/* Smarty version 3.1.29, created on 2016-01-15 15:17:08
  from "C:\xampp\htdocs\bcrianto-mvc\smarty\templates\beheerpagina.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5698ff64472a54_22755163',
  'file_dependency' => 
  array (
    '2d289579de50799a5a899a95c513187553d1f223' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bcrianto-mvc\\smarty\\templates\\beheerpagina.tpl',
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
function content_5698ff64472a54_22755163 ($_smarty_tpl) {
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
