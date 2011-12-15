<?php
class validation_email extends validation {
	protected $message = "Error: %element% must be an email address.";

	public function isValid($value) {
		if($this->isNotApplicable($value) || filter_var($value, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {
			return false;
		}
	}
}