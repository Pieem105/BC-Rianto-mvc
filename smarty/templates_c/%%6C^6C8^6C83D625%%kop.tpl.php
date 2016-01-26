<?php /* Smarty version 2.6.14, created on 2016-01-07 09:31:58
         compiled from kop.tpl */ ?>
		<div class="container-fluid">
		<div class="row" id="kop_id">
								<div class="col-sm-3" id="kop_links_id">
					<a href="index.php?page=1"><img src='./afbeeldingen/logo_blauw.gif' style="height:90px;padding:5px;" /></a>
				</div>
								<div class="col-sm-7" id="kop_middenbalk_id">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
												<div class="carousel-inner" role="listbox">
							<?php if (isset ( $this->_tpl_vars['aAfbeeldingen'] )): ?>
								<?php unset($this->_sections['rij']);
$this->_sections['rij']['name'] = 'rij';
$this->_sections['rij']['loop'] = is_array($_loop=$this->_tpl_vars['aAfbeeldingen']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rij']['show'] = true;
$this->_sections['rij']['max'] = $this->_sections['rij']['loop'];
$this->_sections['rij']['step'] = 1;
$this->_sections['rij']['start'] = $this->_sections['rij']['step'] > 0 ? 0 : $this->_sections['rij']['loop']-1;
if ($this->_sections['rij']['show']) {
    $this->_sections['rij']['total'] = $this->_sections['rij']['loop'];
    if ($this->_sections['rij']['total'] == 0)
        $this->_sections['rij']['show'] = false;
} else
    $this->_sections['rij']['total'] = 0;
if ($this->_sections['rij']['show']):

            for ($this->_sections['rij']['index'] = $this->_sections['rij']['start'], $this->_sections['rij']['iteration'] = 1;
                 $this->_sections['rij']['iteration'] <= $this->_sections['rij']['total'];
                 $this->_sections['rij']['index'] += $this->_sections['rij']['step'], $this->_sections['rij']['iteration']++):
$this->_sections['rij']['rownum'] = $this->_sections['rij']['iteration'];
$this->_sections['rij']['index_prev'] = $this->_sections['rij']['index'] - $this->_sections['rij']['step'];
$this->_sections['rij']['index_next'] = $this->_sections['rij']['index'] + $this->_sections['rij']['step'];
$this->_sections['rij']['first']      = ($this->_sections['rij']['iteration'] == 1);
$this->_sections['rij']['last']       = ($this->_sections['rij']['iteration'] == $this->_sections['rij']['total']);
?>
									<?php if ($this->_sections['rij']['rownum'] != 1): ?>
										<div class="item">
									<?php else: ?>
										<div class="item active">
									<?php endif; ?>
									<img src='<?php echo $this->_tpl_vars['aAfbeeldingen'][$this->_sections['rij']['index']]; ?>
' style="height:100px" />
									</div>
								<?php endfor; else: ?>
									none
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
								<div class="col-sm-2" id="kop_rechts_id">
					<div style="text-align:center">
						<br><?php echo $this->_tpl_vars['aContact']['naam']; ?>
<br>
						<span class="glyphicon glyphicon-earphone" > <?php echo $this->_tpl_vars['aContact']['telefoon']; ?>
</span><br>
						<a href="mailto:<?php echo $this->_tpl_vars['aContact']['email']; ?>
"><span class="glyphicon glyphicon-envelope" style="color:grey"> <?php echo $this->_tpl_vars['aContact']['email']; ?>
</span></a>
					</div>
				</div>
		</div>
	</div>