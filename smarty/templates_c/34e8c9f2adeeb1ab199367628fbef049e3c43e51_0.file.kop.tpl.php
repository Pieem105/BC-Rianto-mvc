<?php
/* Smarty version 3.1.29, created on 2016-01-07 16:23:57
  from "C:\xampp\htdocs\bcrianto-mvc\smarty\templates\kop.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_568e830dda8021_72010839',
  'file_dependency' => 
  array (
    '34e8c9f2adeeb1ab199367628fbef049e3c43e51' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bcrianto-mvc\\smarty\\templates\\kop.tpl',
      1 => 1452155513,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_568e830dda8021_72010839 ($_smarty_tpl) {
?>

	
	<div class="container-fluid">
		<div class="row" id="kop_id">
				
				<div class="col-sm-3" id="kop_links_id">
					<a href="index.php?page=1"><img src='./afbeeldingen/logo_blauw.gif' style="height:90px;padding:5px;" /></a>
				</div>
				
				<div class="col-sm-7" id="kop_middenbalk_id">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						
						<div class="carousel-inner" role="listbox">
							<?php if (isset($_smarty_tpl->tpl_vars['aAfbeeldingen']->value)) {?>
								<?php
$__section_rij_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_rij']) ? $_smarty_tpl->tpl_vars['__smarty_section_rij'] : false;
$__section_rij_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['aAfbeeldingen']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_rij_0_total = $__section_rij_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_rij'] = new Smarty_Variable(array());
if ($__section_rij_0_total != 0) {
for ($__section_rij_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_rij']->value['index'] = 0; $__section_rij_0_iteration <= $__section_rij_0_total; $__section_rij_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_rij']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_rij']->value['rownum'] = $__section_rij_0_iteration;
?>
									<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_rij']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_rij']->value['rownum'] : null) != 1) {?>
										<div class="item">
									<?php } else { ?>
										<div class="item active">
									<?php }?>
									<img src='<?php echo $_smarty_tpl->tpl_vars['aAfbeeldingen']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_rij']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_rij']->value['index'] : null)];?>
' style="height:100px" />
									</div>
								<?php }} else {
 ?>
									none
								<?php
}
if ($__section_rij_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_rij'] = $__section_rij_0_saved;
}
?>
							<?php }?>
						</div>
					</div>
				</div>
				
				<div class="col-sm-2" id="kop_rechts_id">
					<div style="text-align:center">
						<br><?php echo $_smarty_tpl->tpl_vars['aContact']->value['naam'];?>
<br>
						<span class="glyphicon glyphicon-earphone" > <?php echo $_smarty_tpl->tpl_vars['aContact']->value['telefoon'];?>
</span><br>
						<a href="mailto:<?php echo $_smarty_tpl->tpl_vars['aContact']->value['email'];?>
"><span class="glyphicon glyphicon-envelope" style="color:grey"> <?php echo $_smarty_tpl->tpl_vars['aContact']->value['email'];?>
</span></a>
					</div>
				</div>
		</div>
	</div>
<?php }
}
