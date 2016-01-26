<?php /* Smarty version 2.6.14, created on 2016-01-07 16:17:34
         compiled from menu.tpl */ ?>
<?php if (isset ( $this->_tpl_vars['sGebruikerNaam'] ) && ( strlen ( $this->_tpl_vars['sGebruikerNaam'] ) > 0 )): ?>
<div>Ingelogd als <?php echo $this->_tpl_vars['sGebruikerNaam']; ?>
</div>
<?php endif; ?>
<?php if (( isset ( $this->_tpl_vars['aMenu'] ) )): ?>
	
	<div class="container-fluid">
			<div class="row" id="menubar_id">
				<div class="col-sm-12">
					<nav ID="menu_id" class="navbar navbar-default">
					  <div class="container-fluid">
												<div class="navbar-header">
							<a class="navbar-brand">BC Rianto</a>
						</div>
						<div>
															<ul class="nav navbar-nav">
									<?php if ($this->_tpl_vars['aHoofdMenuItem']['link'] == "#"): ?>
										<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->_tpl_vars['aHoofdMenuItem']['titel']; ?>
<span class="caret"></span></a>
										<ul class="dropdown-menu">
																																				<li><a href="<?php echo $this->_tpl_vars['aSubMenuItem']['link']; ?>
"><?php echo $this->_tpl_vars['aSubMenuItem']['titel']; ?>
</a></li>
																							<?php endforeach; endif; unset($_from); ?>
										</ul>
									<?php else: ?>
										<li><a href="<?php echo $this->_tpl_vars['aHoofdMenuItem']['link']; ?>
"><?php echo $this->_tpl_vars['aHoofdMenuItem']['titel']; ?>
</a></li>
									<?php endif; ?>
								</ul>
							<?php endforeach; else: ?>
							<?php endif; unset($_from); ?>
						</div>
					  </div>
					</nav>
				</div>
			</div>
		</div>
	<?php if (( isset ( $this->_tpl_vars['aMenu']['submenu'] ) && ( count ( $this->_tpl_vars['aMenu']['submenu'] ) > 0 ) )): ?>
		<ul id="submenu">
		<?php $_from = $this->_tpl_vars['aMenu']['submenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['aMenuItem']):
?>
			<li><a href="<?php echo $this->_tpl_vars['aMenuItem']['link']; ?>
"><h2><?php echo $this->_tpl_vars['aMenuItem']['titel']; ?>
</h2></a></li>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
	<?php endif; ?>

<?php endif; ?>