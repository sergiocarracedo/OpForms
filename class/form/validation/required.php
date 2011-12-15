<?php
class validation_required extends validation {
	protected $message = "Error: %element% is a required field.";

	public function isValid($value) {
		if(!is_null($value) && ((!is_array($value) && $value !== "") || (is_array($value) && !empty($value)))) {
			return true;
		}
		return false;	
	}
}