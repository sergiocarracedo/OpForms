<?php /* Smarty version Smarty-3.0.8, created on 2011-12-15 10:32:23
         compiled from "/var/www/OpForm/class/form/themes/default/textarea.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9801898214ee9bea7ba2d71-09723877%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '617489793091cdafb9ec2d37024607a44485af5f' => 
    array (
      0 => '/var/www/OpForm/class/form/themes/default/textarea.tpl',
      1 => 1322392806,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9801898214ee9bea7ba2d71-09723877',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<textarea name="<?php echo $_smarty_tpl->getVariable('element')->value['name'];?>
" class="<?php echo $_smarty_tpl->getVariable('element')->value['attributes']['class'];?>
" <?php echo $_smarty_tpl->getVariable('element')->value['attributes']['render'];?>
><?php echo $_smarty_tpl->getVariable('element')->value['value'];?>
</textarea>