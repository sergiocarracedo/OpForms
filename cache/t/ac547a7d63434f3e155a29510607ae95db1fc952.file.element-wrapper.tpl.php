<?php /* Smarty version Smarty-3.0.8, created on 2011-12-15 10:32:23
         compiled from "/var/www/OpForm/class/form/themes/default/element-wrapper.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18437910094ee9bea7b41265-03001144%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac547a7d63434f3e155a29510607ae95db1fc952' => 
    array (
      0 => '/var/www/OpForm/class/form/themes/default/element-wrapper.tpl',
      1 => 1323777303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18437910094ee9bea7b41265-03001144',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="element element-<?php echo $_smarty_tpl->getVariable('element')->value['id'];?>
 element-type-<?php echo $_smarty_tpl->getVariable('element')->value['type'];?>
">
	<label for="<?php echo $_smarty_tpl->getVariable('element')->value['attributes']['id'];?>
">
		<?php echo $_smarty_tpl->getVariable('element')->value['label'];?>

	</label>
	<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('element')->value['template'], $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	
	<?php if ($_smarty_tpl->getVariable('element')->value['errorString']){?>
		<div class="errorString">
			<?php echo $_smarty_tpl->getVariable('element')->value['errorString'];?>

		</div>
	<?php }?>
	
	<div class="description">
		<?php echo $_smarty_tpl->getVariable('element')->value['description'];?>

	</div>
</div>
