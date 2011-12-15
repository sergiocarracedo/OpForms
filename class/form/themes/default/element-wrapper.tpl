<div class="element element-{$element.id} element-type-{$element.type}">
	<label for="{$element.attributes.id}">
		{$element.label}
	</label>
	{include file=$element.template}
	
	{if $element.errorString}
		<div class="errorString">
			{$element.errorString}
		</div>
	{/if}
	
	<div class="description">
		{$element.description}
	</div>
</div>
