<?php
require_once("../addons/easyCRUD/easyCRUD.class.php");
class User Extends Crud {
	protected $table = "users";
	protected $pk	 = "id";
}