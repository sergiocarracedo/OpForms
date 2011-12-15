<select name="{$element.name}" {$element.attributes.render} class="{$element.attributes.class}">
	{foreach from=$element.options key=optionValue item=optionText }
		<option value="{$optionValue}" {if in_array($optionValue,$element.value)} selected="selected"{/if}>{$optionText}</option>
	{/foreach}
</select>