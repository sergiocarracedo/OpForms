{foreach from=$element.options key=optionValue item=optionText }
	<input id="{$element.attributes.id}_{$optionValue}" type="checkbox" name="{$element.name}[]" value="{$optionValue}" {$element.attributes.render} class="{$element.attributes.class}" {if in_array($optionValue,$element.value)} checked="checked"{/if}> 
	<label for="{$element.attributes.id}_{$optionValue}">
		{$optionText}
	</label>
{/foreach}
