<?php
require_once "global_class.php";

class Order extends GlobalClass {
	
	public function __construct($db) {
		parent::__construct("order_name", $db);
	}
	
	public function getAllOnDate($value) {
		return $this->getAllOnField($field = "date", $value);
	}
	
	public function getAllOnWorker($value) {
		return $this->getAllOnField($field = "id_worker", $value);
	}
	
	public function searchOnFields($value1, $value2) {
		return $this->getAllOnFields("date", $value1, "id_worker", $value2);
	}
	
	public function addOrder($array) {
		return $this->add($array);
	}
	
	public function getMergeTables($table2_name, $id1, $id2, $fields) {
		return $this->getTables($table2_name, $id1, $id2, $fields);
	}
	
	public function query1() {
		$query = "SELECT order_name.id_service, sum(order_name.total_cost) FROM order_name GROUP BY order_name.id_service";
		$result_set = $this->query($query);
		while ($row = $result_set->fetch_assoc()) {
			$data[$i] = $row;
			$i++;
		}
		return $data;
	}
}
?>