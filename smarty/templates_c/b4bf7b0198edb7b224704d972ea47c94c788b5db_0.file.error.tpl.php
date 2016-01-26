<?php
/* Smarty version 3.1.29, created on 2016-01-13 16:28:14
  from "C:\xampp\htdocs\bcrianto-mvc\smarty\templates\error.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56966d0e924f06_06281446',
  'file_dependency' => 
  array (
    'b4bf7b0198edb7b224704d972ea47c94c788b5db' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bcrianto-mvc\\smarty\\templates\\error.tpl',
      1 => 1207083086,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:xhtml.tpl' => 1,
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_56966d0e924f06_06281446 ($_smarty_tpl) {
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:xhtml.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<body>
<div class="error">
<h1>Fatale fout</h1>
<h2><?php echo $_smarty_tpl->tpl_vars['aData']->value['exception']['message'];?>
</h2>
<h3><?php echo $_smarty_tpl->tpl_vars['aData']->value['exception']['trace'];?>
</h3>
</div>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
</html>
<?php }
}
