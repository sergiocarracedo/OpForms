<?php
class element_date extends element {
	protected $attributes = array();
	
	public function configure() {		
		$this->validation[] = new validation_date;	
	}
}
