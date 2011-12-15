<?php /* Smarty version Smarty-3.0.8, created on 2011-12-15 10:32:23
         compiled from "/var/www/OpForm/class/form/themes/default/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11992968034ee9bea7a72825-89510934%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba237c36bea1e4c5e3f63c5f370c23aaf8ba0903' => 
    array (
      0 => '/var/www/OpForm/class/form/themes/default/form.tpl',
      1 => 1323791293,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11992968034ee9bea7a72825-89510934',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form action="<?php echo $_smarty_tpl->getVariable('form')->value['action'];?>
" method="<?php echo $_smarty_tpl->getVariable('form')->value['method'];?>
" enctype="<?php echo $_smarty_tpl->getVariable('form')->value['enctype'];?>
" class="form form-<?php echo $_smarty_tpl->getVariable('form')->value['name'];?>
">
	<input type="hidden" name="<?php echo $_smarty_tpl->getVariable('form')->value['name'];?>
" value="<?php echo $_smarty_tpl->getVariable('form')->value['sign'];?>
">

	<fieldset>
		<?php  $_smarty_tpl->tpl_vars['element'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('elements')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['element']->key => $_smarty_tpl->tpl_vars['element']->value){
?>
			<?php $_template = new Smarty_Internal_Template("element-wrapper.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('element',$_smarty_tpl->tpl_vars['element']->value); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
		<?php }} ?>	
	</fieldset>
	
	<input type="submit"  />
</form>