<?php
/* Smarty version 3.1.29, created on 2016-01-15 14:16:09
  from "C:\xampp\htdocs\bcrianto-mvc\smarty\templates\login.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5698f119f32240_34727904',
  'file_dependency' => 
  array (
    '7d8558da9c1de90134308c1a51f2c83693e823ba' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bcrianto-mvc\\smarty\\templates\\login.tpl',
      1 => 1452863762,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:xhtml.tpl' => 1,
    'file:header.tpl' => 1,
    'file:kop.tpl' => 1,
    'file:menu.tpl' => 1,
  ),
),false)) {
function content_5698f119f32240_34727904 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\htdocs\\bcrianto-mvc\\smarty-3.1.29\\libs\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_modifier_capitalize')) require_once 'C:\\xampp\\htdocs\\bcrianto-mvc\\smarty-3.1.29\\libs\\plugins\\modifier.capitalize.php';
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:xhtml.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<body>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:kop.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


	<div id="standaard_inhoud_id" class="container-fluid">
		<div class="row">
			<div class="col-sm-2" id="linker_menu_id" style="height:450px;border-radius:3px">
				
				<div style="height:100%;width:100%;background-image:url(./afbeeldingen/achtergrond_verjaardagen.jpg);
				background-repeat:no-repeat;
				background-size:90%;
				background-position:10px 25px;border-radius:3px">
				
				
				<div style="height:100%;width:100%;background:RGBA(48,48,200,0.8);display:flex;border-radius:3px"> 
				
				<div style="width:100%;padding:5px;color:white">
				
				
				<h4 style="text-align:center;color:white" >Jarigen in de maand<br/><?php echo smarty_modifier_capitalize(smarty_modifier_date_format(time(),"%B"));?>
</h4>

				 
				 
				<table align="center" style="margin-top:20px;color=white">
					<?php
$_from = $_smarty_tpl->tpl_vars['aJarigenVanDeMaand']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_aJarige_0_saved_item = isset($_smarty_tpl->tpl_vars['aJarige']) ? $_smarty_tpl->tpl_vars['aJarige'] : false;
$__foreach_aJarige_0_saved_key = isset($_smarty_tpl->tpl_vars['Key']) ? $_smarty_tpl->tpl_vars['Key'] : false;
$_smarty_tpl->tpl_vars['aJarige'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['Key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['aJarige']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['Key']->value => $_smarty_tpl->tpl_vars['aJarige']->value) {
$_smarty_tpl->tpl_vars['aJarige']->_loop = true;
$__foreach_aJarige_0_saved_local_item = $_smarty_tpl->tpl_vars['aJarige'];
?>
						<tr>
							<td height="20px" width="30px"><?php echo $_smarty_tpl->tpl_vars['aJarige']->value['dag'];?>
</td>
							<td height="20px"><?php echo $_smarty_tpl->tpl_vars['aJarige']->value['naam'];?>
</td>
						</tr>
					<?php
$_smarty_tpl->tpl_vars['aJarige'] = $__foreach_aJarige_0_saved_local_item;
}
if ($__foreach_aJarige_0_saved_item) {
$_smarty_tpl->tpl_vars['aJarige'] = $__foreach_aJarige_0_saved_item;
}
if ($__foreach_aJarige_0_saved_key) {
$_smarty_tpl->tpl_vars['Key'] = $__foreach_aJarige_0_saved_key;
}
?>
				</table>

				</div> 
				
				<div style="position:absolute;left:0px;bottom:10px";width:100<?php echo '%>';?>
				<img src="./afbeeldingen/micky-verjaardag.gif" style="margin-left:10%;width:80%">
				</div> 
				
				</div> 
				</div>  
			</div>
			<div class="col-sm-8" id="inhoud_id">
				<form action="<?php echo $_smarty_tpl->tpl_vars['aData']->value['postlink'];?>
" method="POST">
					<table align="center">
						<tr align="center">
							<td style="padding:10px">Gebruikernaam:</td>
							<td style="padding:10px"><input type="text" name="gebruiker" value="" /><br /></td>
						</tr>
						<tr align="center">
							<td style="padding:10px">Wachtwoord: </td>
							<td style="padding:10px"><input type="password" name="wachtwoord" value="" /></td>
						</tr>
						<tr>
							<td style="padding:10px"></td>
							<td colspan="2" align="left" style="padding:10px"><input type="submit" name="submit" value="Inloggen" /></td>
						</tr>
					</table>
				</form>
			</div>
			<div class="col-sm-2" id="rechter_menu_id" style="height:450px;border-radius:3px">
				<div style=\"height:100%;width:100%;background:RGBA(48,48,200,0.8);display:flex;border-radius:3px\">
					<div style=\"position:absolute;margin-left:8%\">
						<form>
							<h4 style=\"color:white\">Het laatste nieuws!</h4>
							<?php echo '<script'; ?>
>toonRSS('bcrianto','rssOutput',3);<?php echo '</script'; ?>
>
							<select onchange=\"toonRSS(this.value,'rssOutput',3)\" style=\"color:#33A\">
								<option value=\"bcrianto\">BC Rianto - Nieuws</option>
								<option value=\"nbb\">NBB Nieuws</option>
								<option value=\"badminton\">Badminton Info</option>
								<option value=\"bwf\">Badminton Federatie</option>
							</select>  
						</form>
					</div>
					<br>
					<div style=\"position:relative;margin-left:8%;margin-top:70px\" id=\"rssOutput\">
						Hier komt uw nieuws...
					</div>
				</div>
			</div>
</body>
</html>
<?php }
}
