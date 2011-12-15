<?php
abstract class optionElement extends element {
	protected $options;
	protected $multiple = false;

	public function __construct($label, $name, array $options, elementOptions $properties = null) {
		
		$this->options = $options;
		
		if(array_values($this->options) === $this->options) {
			$this->options = array_combine($this->options, $this->options);
		}
		
		if (!is_array($properties->value)) {
			$properties->value=array($properties->value);			
		}

		parent::__construct($label, $name, $properties);
	}
	
	public function getValue() {			
		$value = parent::getValue();
		
		if (!is_array($value)) {
			if ($this->multiple) {
				$value =array($value);
			}
		}
		
		return $value;
	}

	
	public function prepare() {
		$element=parent::prepare();
		
		$element["options"] = $this->options;
		
		/*
		$element=array(
			"template"		=> $this->template,
			"name" 			=> $this->getName(true),
			"value" 		=> $this->getValue(),
			"attributes"	=> $this->getAttributes(),
			"options"		=> $this->options
		);
		*/
		
		return $element;
		
	}
	
	
    
}