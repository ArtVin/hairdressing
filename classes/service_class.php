<?php
require_once "global_class.php";

class Service extends GlobalClass {
	
	public function __construct($db) {
		parent::__construct("service", $db);
	}
	
	public function getAllOnDate() {
		return $this->getAll("id", true);
	}
	
	public function getAllOnName($value) {
		return $this->getAllOnField($field = "name", $value);
	}
	
	public function addService($array) {
		return $this->add($array);
	}
	
	public function updateService($id, $field, $value) {
		return $this->edit($id, $field, $value);
	}
	
	public function deleteService($id) {
		return $this->delete($id);
	}
	
	public function getMergeTables($table2_name, $id1, $id2, $fields) {
		return $this->getTables($table2_name, $id1, $id2, $fields);
	}
	
	public function findID($surname) {
		$id = $this->getField("id", "surname", $surname);
		return $id;
	}
}
?>