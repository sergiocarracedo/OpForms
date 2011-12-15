<?php
class validation_compare extends validation {
	protected $message = "Error: %element% must complaint compare rules.";
	protected $elementToCompare;

	public function __construct($elementToCompare,$message = "") {
		$this->elementToCompare = $elementToCompare;
		parent::__construct($message);
		
		
	}

	public function isValid($value) {
		return true;
	}
	
	public function getComparedElementValue() {
		
		if (isset($this->formElements[$this->elementToCompare])) {
			return $this->formElements[$this->elementToCompare]->getValue();
		} else {
			throw new Exception("Element to be compared ($this->elementToCompare) don't exists.");
		}
	}
}
