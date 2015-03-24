<?php
require_once "global_class.php";

class Equipment extends GlobalClass {
	
	public function __construct($db) {
		parent::__construct("equipment", $db);
	}
	
	public function getAllOnDate() {
		return $this->getAll("id", true);
	}
	
	public function addEquipment($array) {
		return $this->add($array);
	}
	
	public function updateEquipment($id, $field, $value) {
		return $this->edit($id, $field, $value);
	}
	
	public function deleteEquipment($id) {
		return $this->delete($id);
	}
	
	public function getMergeTables($table2_name, $id1, $id2, $fields) {
		return $this->getTables($table2_name, $id1, $id2, $fields);
	}
}
?>