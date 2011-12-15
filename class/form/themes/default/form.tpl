<form action="{$form.action}" method="{$form.method}" enctype="{$form.enctype}" class="form form-{$form.name}">
	{* Form name & form signature *}
	<input type="hidden" name="{$form.name}" value="{$form.sign}">

	<fieldset>
		{foreach from=$elements item=element}
			{include file="element-wrapper.tpl" element=$element}
		{/foreach}	
	</fieldset>
	
	<input type="submit"  />
</form>