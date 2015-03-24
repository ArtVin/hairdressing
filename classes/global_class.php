<?php
require_once "config_class.php";
require_once "database_class.php";

abstract class GlobalClass {
	
	private $db;
	private $table_name;
	protected $config;
	
	protected function __construct($table_name, $db) {
		$this->db = $db;
		$this->table_name = $table_name;
		$this->config = new Config();
	}
	
	protected function query($query) {
		return $this->db->query($query);
	}
	
	protected function add($new_values) {
		return $this->db->insert($this->table_name, $new_values);
	}
	
	protected function getTables($table2_name, $id1, $id2, $fields) {
		return $this->db->selectTables($this->table_name, $table2_name, $id1, $id2, $fields);
	}
	
	protected function edit($id, $field, $value) {
		return $this->db->setFieldOnID($this->table_name, $id, $field, $value);
	}
	
	public function delete($id) {
		return $this->db->deleteOnID($this->table_name, $id);
	}
	
	public function deleteAll() {
		return $this->db->deleteAll($this->table_name);
	}
	
	protected function getField($field_out, $field_in, $value_in) {
		return $this->db->getField($this->table_name, $field_out, $field_in, $value_in);
	}
	
	protected function getFieldOnID($id, $field) {
		return $this->db->getFieldOnID($this->table_name, $id, $field);
	}
	
	protected function setFieldOnID($id, $field, $value) {
		return $this->db->setFieldOnID($this->table_name, $id, $field, $value);
	}
	
	public function get($id) {
		return $this->db->getElementOnID($this->table_name, $id);
	}
	
	public function getAll($order = "", $up = true) {
		return $this->db->getAll($this->table_name, $order, $up);
	}
	
	protected function getAllOnField($field, $value, $order = "", $up = true) {
		return $this->db->getAllOnField($this->table_name, $field, $value, $order, $up);
	}
	
	public function getAllOnFields($field1, $value1, $field2, $value2, $order = "", $up = true) {
		return $this->db->getAllOnFields($this->table_name, $field1, $value1, $field2, $value2, $order, $up);
	}
	
	public function getRandomElement($count) {
		return $this->db->getRandomElement($this->table_name, $count);
	}
	
	public function getLastID() {
		return $this->db->getLastID($this->table_name);
	}
	
	public function getCount() {
		return $this->db->getCount($this->table_name);
	}
	
	protected function isExists($field, $value) {
		return $this->db->isExists($this->table_name, $field, $value);
	}
	
	protected function search($words, $fields) {
		return $this->db->search($this->table_name, $words, $fields);
	}
}
?>