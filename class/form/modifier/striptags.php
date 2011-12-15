<?php

	class modifier_striptags extends modifier {
		
		public function getModifiedValue($value) {
			return strip_tags($value);
		}
	}
?>