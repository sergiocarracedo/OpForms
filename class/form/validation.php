<?php
abstract class validation  {
	protected $message = "%element% is invalid.";
	protected $formElements = null;

	public function __construct($message = "") {
		if(!empty($message)) {
			$this->message = $message;
		}
	}

	public function getMessage() {
		return $this->message;
	}
	
	public function isNotApplicable($value) {
		if(is_null($value) || is_array($value) || $value === "") {
			return true;
		}
		return false;
	}
		
	public abstract function isValid($value);
	
	
	public function setFormElements(&$elements) {
		$this->formElements=$elements;		
	}
	
}
