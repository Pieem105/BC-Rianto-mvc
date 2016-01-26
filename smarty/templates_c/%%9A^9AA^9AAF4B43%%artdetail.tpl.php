<?php /* Smarty version 2.6.14, created on 2008-04-07 14:20:02
         compiled from artdetail.tpl */ ?>
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
<div class="center"><div class="left-block">
<?php if (isset ( $this->_tpl_vars['aData']['artikel'] )): ?>
<div>Naam: <?php echo $this->_tpl_vars['aData']['artikel']['Naam']; ?>
</div>
<div>Korte omschrijving: <?php echo $this->_tpl_vars['aData']['artikel']['KorteOmschrijving']; ?>
</div>
<div>Omschrijving: <?php echo $this->_tpl_vars['aData']['artikel']['Omschrijving']; ?>
</div>
<div>Prijs: <?php echo $this->_tpl_vars['aData']['artikel']['Prijs']; ?>
</div>
<div>Aantal op voorraad: <?php echo $this->_tpl_vars['aData']['artikel']['Aantal']; ?>
</div>
<?php if (( isset ( $this->_tpl_vars['aData']['artikel']['AfbeeldingURL'] ) && ( strlen ( $this->_tpl_vars['aData']['artikel']['AfbeeldingURL'] ) > 0 ) )): ?>
<img src="<?php echo $this->_tpl_vars['aData']['artikel']['AfbeeldingURL']; ?>
" alt="" />
<?php endif; ?>
<?php endif; ?>
</div>
<?php if (( isset ( $this->_tpl_vars['aData']['magaanpassen'] ) && $this->_tpl_vars['aData']['magaanpassen'] )): ?>
	<a href="<?php echo $this->_tpl_vars['aData']['aanpasscherm'];  echo $this->_tpl_vars['aData']['artikel']['Id']; ?>
">Aanpassen</a>
<?php endif; ?>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>