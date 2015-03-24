<?php
require_once "global_class.php";

class Client extends GlobalClass {
	
	public function __construct($db) {
		parent::__construct("client", $db);
	}
	
	public function getAllOnDate($order) {
		return $this->getAll($order, true);
	}
	
	public function getAllOnName($value) {
		return $this->getAllOnField($field = "name", $value);
	}
	
	public function getAllOnSurname() {
		return $this->getAll("surname", true);
	}
	
	public function addClient($array) {
		return $this->add($array);
	}
	
	public function updateClient($id, $field, $value) {
		return $this->edit($id, $field, $value);
	}
	
	public function deleteClient($id) {
		return $this->delete($id);
	}
	
	public function findID($surname) {
		$surname = substr($surname, 0, -7);
		$id = $this->getField("id", "surname", $surname);
		return $id;
	}
}
?>