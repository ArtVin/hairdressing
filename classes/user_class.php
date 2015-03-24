<?php
require_once "global_class.php";

class User extends GlobalClass {
	
	public function __construct($db) {
		parent::__construct("user", $db);
	}
	
	public function checkUser($login, $password) {
		$user = $this->getUserOnLogin($login);
		if (!$user) return false;
		return $user["password"] === $password;
	}
	
	public function getUserOnLogin($login) {
		$id = $this->getField("id", "login", $login);
		return $this->get($id);
	}
}
?>