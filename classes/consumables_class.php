<?php
require_once "global_class.php";

class Consumables extends GlobalClass {
	
	public function __construct($db) {
		parent::__construct("consumables", $db);
	}
	
	public function getAllOnDate() {
		return $this->getAll("id", true);
	}
	
	public function addConsumables($array) {
		return $this->add($array);
	}
	
	public function updateConsumables($id, $field, $value) {
		return $this->edit($id, $field, $value);
	}
	
	public function deleteConsumables($id) {
		return $this->delete($id);
	}
	
	public function getCost($id) {
		$data = $this->get($id);
		$cost = $data["cost"];
		return $cost;
	}
}
?>