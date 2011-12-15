<?php
class validation_equal extends validation_compare  {
	protected $message = "Error: %element% values must be equal.";

	public function isValid($value) {
		if($this->isNotApplicable($value) || $value==$this->getComparedElementValue()) {
			return true;
		} 
		return false;	
	}
}
