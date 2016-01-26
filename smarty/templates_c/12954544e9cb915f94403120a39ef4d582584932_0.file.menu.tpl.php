<?php
/* Smarty version 3.1.29, created on 2016-01-07 18:22:41
  from "C:\xampp\htdocs\bcrianto-mvc\smarty\templates\menu.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_568e9ee1d5a743_98480487',
  'file_dependency' => 
  array (
    '12954544e9cb915f94403120a39ef4d582584932' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bcrianto-mvc\\smarty\\templates\\menu.tpl',
      1 => 1452187345,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_568e9ee1d5a743_98480487 ($_smarty_tpl) {
?>

<?php if (isset($_smarty_tpl->tpl_vars['sGebruikerNaam']->value) && (strlen($_smarty_tpl->tpl_vars['sGebruikerNaam']->value) > 0)) {?>
<div>Ingelogd als <?php echo $_smarty_tpl->tpl_vars['sGebruikerNaam']->value;?>
</div>
<?php }
if ((isset($_smarty_tpl->tpl_vars['aMenu']->value))) {?>
	

	<div class="container-fluid">
		<div class="row" id="menubar_id">
			<div class="col-sm-12">
				<nav ID="menu_id" class="navbar navbar-default">
				  <div class="container-fluid">
					
					<div class="navbar-header">
						<a class="navbar-brand">BC Rianto</a>
					</div>
					<div>
						<?php
$_from = $_smarty_tpl->tpl_vars['aMenu']->value['hoofdmenu'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_aHoofdMenuItem_0_saved_item = isset($_smarty_tpl->tpl_vars['aHoofdMenuItem']) ? $_smarty_tpl->tpl_vars['aHoofdMenuItem'] : false;
$_smarty_tpl->tpl_vars['aHoofdMenuItem'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['aHoofdMenuItem']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['aHoofdMenuItem']->key => $_smarty_tpl->tpl_vars['aHoofdMenuItem']->value) {
$_smarty_tpl->tpl_vars['aHoofdMenuItem']->_loop = true;
$__foreach_aHoofdMenuItem_0_saved_local_item = $_smarty_tpl->tpl_vars['aHoofdMenuItem'];
?>
							<ul class="nav navbar-nav">
								<?php if ($_smarty_tpl->tpl_vars['aHoofdMenuItem']->value['link'] == "#") {?>
									<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_smarty_tpl->tpl_vars['aHoofdMenuItem']->value['titel'];?>
<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<?php
$_from = $_smarty_tpl->tpl_vars['aMenu']->value['submenu'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_aSubMenuItem_1_saved_item = isset($_smarty_tpl->tpl_vars['aSubMenuItem']) ? $_smarty_tpl->tpl_vars['aSubMenuItem'] : false;
$__foreach_aSubMenuItem_1_saved_key = isset($_smarty_tpl->tpl_vars['subMenuKey']) ? $_smarty_tpl->tpl_vars['subMenuKey'] : false;
$_smarty_tpl->tpl_vars['aSubMenuItem'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['subMenuKey'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['aSubMenuItem']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['aSubMenuItem']->key => $_smarty_tpl->tpl_vars['aSubMenuItem']->value) {
$_smarty_tpl->tpl_vars['aSubMenuItem']->_loop = true;
$_smarty_tpl->tpl_vars['subMenuKey']->value = $_smarty_tpl->tpl_vars['aSubMenuItem']->key;
$__foreach_aSubMenuItem_1_saved_local_item = $_smarty_tpl->tpl_vars['aSubMenuItem'];
?>
											<?php if ($_smarty_tpl->tpl_vars['aHoofdMenuItem']->key == $_smarty_tpl->tpl_vars['aSubMenuItem']->key) {?>
												<?php
$_from = $_smarty_tpl->tpl_vars['aMenu']->value['submenu'][$_smarty_tpl->tpl_vars['subMenuKey']->value];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_aSubItem_2_saved_item = isset($_smarty_tpl->tpl_vars['aSubItem']) ? $_smarty_tpl->tpl_vars['aSubItem'] : false;
$__foreach_aSubItem_2_saved_key = isset($_smarty_tpl->tpl_vars['subKey']) ? $_smarty_tpl->tpl_vars['subKey'] : false;
$_smarty_tpl->tpl_vars['aSubItem'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['subKey'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['aSubItem']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['subKey']->value => $_smarty_tpl->tpl_vars['aSubItem']->value) {
$_smarty_tpl->tpl_vars['aSubItem']->_loop = true;
$__foreach_aSubItem_2_saved_local_item = $_smarty_tpl->tpl_vars['aSubItem'];
?>
													<li><a href="<?php echo $_smarty_tpl->tpl_vars['aSubItem']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['aSubItem']->value['titel'];?>
</a></li>
												<?php
$_smarty_tpl->tpl_vars['aSubItem'] = $__foreach_aSubItem_2_saved_local_item;
}
if ($__foreach_aSubItem_2_saved_item) {
$_smarty_tpl->tpl_vars['aSubItem'] = $__foreach_aSubItem_2_saved_item;
}
if ($__foreach_aSubItem_2_saved_key) {
$_smarty_tpl->tpl_vars['subKey'] = $__foreach_aSubItem_2_saved_key;
}
?>
											<?php }?>
										<?php
$_smarty_tpl->tpl_vars['aSubMenuItem'] = $__foreach_aSubMenuItem_1_saved_local_item;
}
if ($__foreach_aSubMenuItem_1_saved_item) {
$_smarty_tpl->tpl_vars['aSubMenuItem'] = $__foreach_aSubMenuItem_1_saved_item;
}
if ($__foreach_aSubMenuItem_1_saved_key) {
$_smarty_tpl->tpl_vars['subMenuKey'] = $__foreach_aSubMenuItem_1_saved_key;
}
?>
									</ul>
								<?php } else { ?>
									<li><a href="<?php echo $_smarty_tpl->tpl_vars['aHoofdMenuItem']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['aHoofdMenuItem']->value['titel'];?>
</a></li>
								<?php }?>
							</ul>
						<?php
$_smarty_tpl->tpl_vars['aHoofdMenuItem'] = $__foreach_aHoofdMenuItem_0_saved_local_item;
}
if ($__foreach_aHoofdMenuItem_0_saved_item) {
$_smarty_tpl->tpl_vars['aHoofdMenuItem'] = $__foreach_aHoofdMenuItem_0_saved_item;
}
?>
					</div>
				  </div>
				</nav>
			</div>
		</div>
	</div>
<?php }
}
}
