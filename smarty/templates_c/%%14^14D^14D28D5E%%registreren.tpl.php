<?php /* Smarty version 2.6.14, created on 2008-04-07 14:20:23
         compiled from registreren.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'registreren.tpl', 42, false),)), $this); ?>
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
<?php if (( isset ( $this->_tpl_vars['aData']['melding'] ) && strlen ( $this->_tpl_vars['aData']['melding'] ) > 0 )): ?> 
<div class="error"><?php echo $this->_tpl_vars['aData']['melding']; ?>
</div>
<?php endif; ?>
<div class="left-block">
<?php if (! ( isset ( $this->_tpl_vars['aData']['opgeslagen'] ) && ( $this->_tpl_vars['aData']['opgeslagen'] ) )): ?>
<?php if (isset ( $this->_tpl_vars['aData']['velden'] )): ?>
	<form method="POST" action="<?php echo $this->_tpl_vars['aData']['postlink']; ?>
">
	<?php if ($this->_tpl_vars['aData']['velden']['voorletters']['resultaat']): ?>
		<?php $this->assign('sClass', 'normaal'); ?>
	<?php else: ?>
		<?php $this->assign('sClass', 'error'); ?>
	<?php endif; ?> <?php if ($this->_tpl_vars['aData']['velden']['voorletters']['verplicht']): ?> * <?php endif; ?>
	<span class="<?php echo $this->_tpl_vars['sClass']; ?>
"><?php echo $this->_tpl_vars['aData']['velden']['voorletters']['tekst']; ?>
 </span><input type="text" name="voorletters" value="<?php echo $this->_tpl_vars['aData']['velden']['voorletters']['waarde']; ?>
"/><br />

	<?php if ($this->_tpl_vars['aData']['velden']['voornaam']['resultaat']): ?>
		<?php $this->assign('sClass', 'normaal'); ?>
	<?php else: ?>
		<?php $this->assign('sClass', 'error'); ?>
	<?php endif; ?> <?php if ($this->_tpl_vars['aData']['velden']['voornaam']['verplicht']): ?> * <?php endif; ?>
	<span class="<?php echo $this->_tpl_vars['sClass']; ?>
"><?php echo $this->_tpl_vars['aData']['velden']['voornaam']['tekst']; ?>
 </span><input type="text" name="voornaam" value="<?php echo $this->_tpl_vars['aData']['velden']['voornaam']['waarde']; ?>
"/><br />

	<?php if ($this->_tpl_vars['aData']['velden']['tussenvoegsel']['resultaat']): ?>
		<?php $this->assign('sClass', 'normaal'); ?>
	<?php else: ?>
		<?php $this->assign('sClass', 'error'); ?>
	<?php endif; ?> <?php if ($this->_tpl_vars['aData']['velden']['tussenvoegsel']['verplicht']): ?> * <?php endif; ?>
	<span class="<?php echo $this->_tpl_vars['sClass']; ?>
"><?php echo $this->_tpl_vars['aData']['velden']['tussenvoegsel']['tekst']; ?>
 </span><input type="text" name="tussenvoegsel" value="<?php echo $this->_tpl_vars['aData']['velden']['tussenvoegsel']['waarde']; ?>
"/><br />

	<?php if ($this->_tpl_vars['aData']['velden']['achternaam']['resultaat']): ?>
		<?php $this->assign('sClass', 'normaal'); ?>
	<?php else: ?>
		<?php $this->assign('sClass', 'error'); ?>
	<?php endif; ?> <?php if ($this->_tpl_vars['aData']['velden']['achternaam']['verplicht']): ?> * <?php endif; ?>
	<span class="<?php echo $this->_tpl_vars['sClass']; ?>
"><?php echo $this->_tpl_vars['aData']['velden']['achternaam']['tekst']; ?>
 </span><input type="text" name="achternaam" value="<?php echo $this->_tpl_vars['aData']['velden']['achternaam']['waarde']; ?>
"/><br />

	<span class="normaal"><?php echo $this->_tpl_vars['aData']['velden']['geslacht']['tekst']; ?>
</span><?php echo smarty_function_html_options(array('name' => 'geslacht','options' => $this->_tpl_vars['aData']['geslachten'],'selected' => $this->_tpl_vars['aData']['velden']['geslacht']['waarde']), $this);?>
<br />

	<?php if ($this->_tpl_vars['aData']['velden']['email']['resultaat']): ?>
		<?php $this->assign('sClass', 'normaal'); ?>
	<?php else: ?>
		<?php $this->assign('sClass', 'error'); ?>
	<?php endif; ?> <?php if ($this->_tpl_vars['aData']['velden']['email']['verplicht']): ?> * <?php endif; ?>
	<span class="<?php echo $this->_tpl_vars['sClass']; ?>
"><?php echo $this->_tpl_vars['aData']['velden']['email']['tekst']; ?>
 </span><input type="text" name="email" value="<?php echo $this->_tpl_vars['aData']['velden']['email']['waarde']; ?>
"/><br />

	<?php if ($this->_tpl_vars['aData']['velden']['telefoon']['resultaat']): ?>
		<?php $this->assign('sClass', 'normaal'); ?>
	<?php else: ?>
		<?php $this->assign('sClass', 'error'); ?>
	<?php endif; ?> <?php if ($this->_tpl_vars['aData']['velden']['telefoon']['verplicht']): ?> * <?php endif; ?>
	<span class="<?php echo $this->_tpl_vars['sClass']; ?>
"><?php echo $this->_tpl_vars['aData']['velden']['telefoon']['tekst']; ?>
 </span><input type="text" name="telefoon" value="<?php echo $this->_tpl_vars['aData']['velden']['telefoon']['waarde']; ?>
"/><br />

	<?php if ($this->_tpl_vars['aData']['velden']['rekening']['resultaat']): ?>
		<?php $this->assign('sClass', 'normaal'); ?>
	<?php else: ?>
		<?php $this->assign('sClass', 'error'); ?>
	<?php endif; ?> <?php if ($this->_tpl_vars['aData']['velden']['rekening']['verplicht']): ?> * <?php endif; ?>
	<span class="<?php echo $this->_tpl_vars['sClass']; ?>
"><?php echo $this->_tpl_vars['aData']['velden']['rekening']['tekst']; ?>
 </span><input type="text" name="rekening" value="<?php echo $this->_tpl_vars['aData']['velden']['rekening']['waarde']; ?>
"/><br />
	<br />
	<?php if ($this->_tpl_vars['aData']['velden']['straat']['resultaat']): ?>
		<?php $this->assign('sClass', 'normaal'); ?>
	<?php else: ?>
		<?php $this->assign('sClass', 'error'); ?>
	<?php endif; ?> <?php if ($this->_tpl_vars['aData']['velden']['straat']['verplicht']): ?> * <?php endif; ?>
	<span class="<?php echo $this->_tpl_vars['sClass']; ?>
"><?php echo $this->_tpl_vars['aData']['velden']['straat']['tekst']; ?>
 </span><input type="text" name="straat" value="<?php echo $this->_tpl_vars['aData']['velden']['straat']['waarde']; ?>
"/><br />

	<?php if ($this->_tpl_vars['aData']['velden']['huisnr']['resultaat']): ?>
		<?php $this->assign('sClass', 'normaal'); ?>
	<?php else: ?>
		<?php $this->assign('sClass', 'error'); ?>
	<?php endif; ?> <?php if ($this->_tpl_vars['aData']['velden']['huisnr']['verplicht']): ?> * <?php endif; ?>
	<span class="<?php echo $this->_tpl_vars['sClass']; ?>
"><?php echo $this->_tpl_vars['aData']['velden']['huisnr']['tekst']; ?>
 </span><input type="text" name="huisnr" value="<?php echo $this->_tpl_vars['aData']['velden']['huisnr']['waarde']; ?>
"/><br />

	<?php if ($this->_tpl_vars['aData']['velden']['huisnrextra']['resultaat']): ?>
		<?php $this->assign('sClass', 'normaal'); ?>
	<?php else: ?>
		<?php $this->assign('sClass', 'error'); ?>
	<?php endif; ?> <?php if ($this->_tpl_vars['aData']['velden']['huisnrextra']['verplicht']): ?> * <?php endif; ?>
	<span class="<?php echo $this->_tpl_vars['sClass']; ?>
"><?php echo $this->_tpl_vars['aData']['velden']['huisnrextra']['tekst']; ?>
 </span><input type="text" name="huisnrextra" value="<?php echo $this->_tpl_vars['aData']['velden']['huisnrextra']['waarde']; ?>
"/><br />

	<?php if ($this->_tpl_vars['aData']['velden']['postcode']['resultaat']): ?>
		<?php $this->assign('sClass', 'normaal'); ?>
	<?php else: ?>
		<?php $this->assign('sClass', 'error'); ?>
	<?php endif; ?> <?php if ($this->_tpl_vars['aData']['velden']['postcode']['verplicht']): ?> * <?php endif; ?>
	<span class="<?php echo $this->_tpl_vars['sClass']; ?>
"><?php echo $this->_tpl_vars['aData']['velden']['postcode']['tekst']; ?>
 </span><input type="text" name="postcode" value="<?php echo $this->_tpl_vars['aData']['velden']['postcode']['waarde']; ?>
"/><br />

	<?php if ($this->_tpl_vars['aData']['velden']['woonplaats']['resultaat']): ?>
		<?php $this->assign('sClass', 'normaal'); ?>
	<?php else: ?>
		<?php $this->assign('sClass', 'error'); ?>
	<?php endif; ?> <?php if ($this->_tpl_vars['aData']['velden']['woonplaats']['verplicht']): ?> * <?php endif; ?>
	<span class="<?php echo $this->_tpl_vars['sClass']; ?>
"><?php echo $this->_tpl_vars['aData']['velden']['woonplaats']['tekst']; ?>
 </span><input type="text" name="woonplaats" value="<?php echo $this->_tpl_vars['aData']['velden']['woonplaats']['waarde']; ?>
"/><br />
	<br />
	<input type="submit" name="submit" value="Registreren" />
	</form>
<?php endif; ?>
<?php endif; ?>
</div></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>