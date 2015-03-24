<?php
require_once "global_class.php";

class Worker extends GlobalClass {
	
	public function __construct($db) {
		parent::__construct("worker", $db);
	}
	
	public function getAllOnDate() {
		return $this->getAll("id", true);
	}
	
	public function addWorker($array) {
		return $this->add($array);
	}
	
	public function updateWorker($id, $field, $value) {
		return $this->edit($id, $field, $value);
	}
	
	public function deleteWorker($id) {
		return $this->delete($id);
	}
	
	public function findID($surname) {
		$surname = substr($surname, 0, -7);
		
		$id = $this->getField("id", "surname", $surname);
		
		return $id;
	}
}
?>