<?php
class User {
	public $username;
	public $email;
	public $password;
	
	public function __construct($a,$b,$c){
		$this->username		= $a;
		$this->email		= $b;
		$this->password		= $c;
	}
}
