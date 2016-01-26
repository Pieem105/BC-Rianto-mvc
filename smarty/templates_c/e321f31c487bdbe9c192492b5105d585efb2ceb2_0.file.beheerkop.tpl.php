<?php
/* Smarty version 3.1.29, created on 2016-01-19 16:45:01
  from "C:\xampp\htdocs\bcrianto-mvc\smarty\templates\beheerkop.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_569e59fd63d647_28338145',
  'file_dependency' => 
  array (
    'e321f31c487bdbe9c192492b5105d585efb2ceb2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bcrianto-mvc\\smarty\\templates\\beheerkop.tpl',
      1 => 1453218285,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_569e59fd63d647_28338145 ($_smarty_tpl) {
?>

	
	<div class="container-fluid">
		<div class="row" id="kop_id">
				
				<div class="col-sm-1" id="kop_links_id">
					<a href="index.php?page=1"><img src='./afbeeldingen/logo_rianto.gif' style="height:90px;padding:5px;" /></a>
				</div>
				
				<div class="col-sm-9" id="kop_middenbalk_id">
                    <h2>Beheerpagina</h2>
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
