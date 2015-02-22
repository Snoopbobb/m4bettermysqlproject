<?php 
class Validate {
	public function isValid($input) {
        /** @noinspection PhpUndefinedFieldInspection */
        if(!preg_match($this->regex, $input)) {
			return false;
		} else {
			return true;
		}
	}
}