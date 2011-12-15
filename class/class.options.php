<?php

	class options {
		
		public function __construct($optionsArray=array()) {			
			$class = get_class($this);
            $available = array_keys(get_class_vars($class));
            
			foreach($optionsArray as $paramName => $paramValue) {				
				if (in_array($paramName,$available)) {
					$this->$paramName=$paramValue;		
								
				}
			}
		}
		
	}



?>