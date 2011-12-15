<?php
class element_email extends element {
	protected $attributes = array();
	
	public function configure() {		
		$this->validation[] = new validation_email;	
	}
}
