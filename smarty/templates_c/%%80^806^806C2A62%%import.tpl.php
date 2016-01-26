<?php /* Smarty version 2.6.14, created on 2008-04-06 20:04:34
         compiled from import.tpl */ ?>
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
<div class="center">
<?php if (isset ( $this->_tpl_vars['aData']['resultaat'] )): ?>
<div class="result"><?php echo $this->_tpl_vars['aData']['resultaat']['correct']; ?>
 elementen geimporteerd</div>
<div class="result"><?php echo $this->_tpl_vars['aData']['resultaat']['fout']; ?>
 elementen genegeerd wegens foute gegevens</div>
<div class="result"><?php echo $this->_tpl_vars['aData']['resultaat']['dubbel']; ?>
 elementen genegeerd omdat element al bestond</div>
<div class="result"><?php echo $this->_tpl_vars['aData']['resultaat']['melding']; ?>
</div>
<?php else: ?>
<form action="<?php echo $this->_tpl_vars['aData']['postlink']; ?>
" enctype="multipart/form-data" method="POST">
Importbestand: <input type="file" name="import" value="" /><br />
Type:	<select name="importtype">
<?php $_from = $this->_tpl_vars['aData']['typen']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value'] => $this->_tpl_vars['naam']):
?>
<option value="<?php echo $this->_tpl_vars['value']; ?>
"><?php echo $this->_tpl_vars['naam']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select><br />
Importeer	<select name="importsoort">
<?php $_from = $this->_tpl_vars['aData']['soorten']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value'] => $this->_tpl_vars['naam']):
?>
<option value="<?php echo $this->_tpl_vars['value']; ?>
"><?php echo $this->_tpl_vars['naam']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
<option value="xml" checked>XML</option><option value="csv">CSV</option>
</select><br />
<input type="submit" name="submit" value="Importeren" />
</form>
<?php endif; ?>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>