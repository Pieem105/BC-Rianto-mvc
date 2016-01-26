<?php /* Smarty version 2.6.14, created on 2016-01-05 18:29:46
         compiled from header.tpl */ ?>
<head>
	<title><?php echo $this->_tpl_vars['sTitel']; ?>
</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/rianto.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.bcrianto.min.css">
	<link rel="stylesheet" type="text/css" href="css/complete-boek.css" />
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<meta   name="description" content="Op deze website vindt u informatie over BC Rianto, de badmintonclub van Zutphen">
	<meta   name="Keywords" content="badminton; zutphen; badmintonvereniging rianto; badmintonclub; bc rianto">
	<?php if (( isset ( $this->_tpl_vars['aScripts'] ) && ( count ( $this->_tpl_vars['aScripts'] ) > 0 ) )): ?>
	<?php $_from = $this->_tpl_vars['aScripts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sScriptFile']):
?>
	<script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['sScriptFile']; ?>
"></script>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
</head>