<?php
class validation_numeric extends validation {
	protected $message = "Error: %element% must be numeric.";

	public function isValid($value) {
		if($this->isNotApplicable($value) || is_numeric($value)) {
			return true;
		} 
		return false;	
	}
}
