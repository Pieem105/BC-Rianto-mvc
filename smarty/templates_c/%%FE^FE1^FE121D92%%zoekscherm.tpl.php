<?php /* Smarty version 2.6.14, created on 2008-04-06 17:08:12
         compiled from zoekscherm.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "xhtml.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form id="zoekform" action="<?php echo $this->_tpl_vars['aData']['postlink']; ?>
" method="POST">
	<input type="hidden" name="sorteer" id="sorteer" value="" />
	<?php if (( isset ( $this->_tpl_vars['aData']['zoekterm'] ) && ( $this->_tpl_vars['aData']['zoekterm'] != '' ) )): ?>
	zoek: <input type="text" name="zoek" value="<?php echo $this->_tpl_vars['aData']['zoekterm']; ?>
" />
	<?php else: ?>
	zoek: <input type="text" name="zoek" value="" />
	<?php endif; ?>
	<input type="submit" name="submit" value="Zoek" />
	<input type="submit" name="submit" value="Zoek geavanceerd" />
</form>
<div>
<ul>
<?php $_from = $this->_tpl_vars['aData']['categories']['lijst']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['aCategorie']):
?>
<li><a href="<?php echo $this->_tpl_vars['aData']['postlink'];  echo $this->_tpl_vars['aCategorie']['Id']; ?>
"><?php echo $this->_tpl_vars['aCategorie']['Naam']; ?>
</a></li>
<?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<?php if (( isset ( $this->_tpl_vars['aData']['resultaat'] ) && ( $this->_tpl_vars['aData']['resultaat'] == true ) )): ?>
	<table class="lijst">
	<thead><tr>
	<?php if (( isset ( $this->_tpl_vars['aData']['magbestellen'] ) && ( $this->_tpl_vars['aData']['magbestellen'] ) )): ?>
	<td>Winkelwagen</td>
	<?php endif; ?>
	<?php $_from = $this->_tpl_vars['aData']['kolommen']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['aKolom']):
?>
	<td><?php echo $this->_tpl_vars['aKolom']['naam']; ?>
</td>
	<?php endforeach; endif; unset($_from); ?>
	<?php if (( isset ( $this->_tpl_vars['aData']['magaanpassen'] ) && ( $this->_tpl_vars['aData']['magaanpassen'] ) )): ?>
	<td>Aanpassen</td>
	<?php endif; ?>
	</tr></thead>
	<tbody>
	<?php $_from = $this->_tpl_vars['aData']['lijst']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['aGegevens']):
?>
	<tr>
		<?php if (( isset ( $this->_tpl_vars['aData']['magbestellen'] ) && ( $this->_tpl_vars['aData']['magbestellen'] ) )): ?>
		<td><a href="<?php echo $this->_tpl_vars['aData']['bestelscherm'];  echo $this->_tpl_vars['aGegevens']['Id']; ?>
">in winkelwagen</a></td>
		<?php endif; ?>
		<td><a href="<?php echo $this->_tpl_vars['aData']['detailscherm'];  echo $this->_tpl_vars['aGegevens']['Id']; ?>
"><?php echo $this->_tpl_vars['aGegevens']['Naam']; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['aGegevens']['KorteOmschrijving']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aGegevens']['Prijs']; ?>
</td>
		<?php if (( isset ( $this->_tpl_vars['aData']['magaanpassen'] ) && ( $this->_tpl_vars['aData']['magaanpassen'] ) )): ?>
		<td><a href="<?php echo $this->_tpl_vars['aData']['aanpasscherm'];  echo $this->_tpl_vars['aGegevens']['Id']; ?>
">aanpassen</a></td>
		<?php endif; ?>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	</tbody>
	</table>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>