<?php 
class EmailValidate extends Validate {
	protected $regex = '/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/';
}

