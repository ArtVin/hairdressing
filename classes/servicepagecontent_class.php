<?php
require_once "modules_class.php";

class ServicePageContent extends Modules {
	
	private $services;
	private $names_cons;
	private $names_eq;
	
	public function __construct($db) {
		parent::__construct($db);
		$this->services = $this->service->getAllOnDate();
		$this->names_cons = $this->service->getMergeTables("consumables", "id_cons", "id", "t2.name");
		$this->names_eq = $this->service->getMergeTables("equipment", "id_eq", "id", "t2.name");
		// echo "<pre>";
		// print_r($this->names_cons);
		// echo "</pre>";
	}
	
	protected function getMiddle() {
		$x = 1;
		for ($i = 0; $i < count($this->services); $i++) {
			if ($x == 1) {
				$blank1["color_row"] = "white_row";
				$x = 0;
			} else {
				$blank1["color_row"] = "black_row";
				$x = 1;
			}
			$blank1["id"] = $this->services[$i]["id"];
			
			$blank1["id_cons"] = $this->names_cons[$i]["name"];
			$blank1["id_eq"] = $this->names_eq[$i]["name"];
			$blank1["name"] = $this->services[$i]["name"];
			$blank1["duration"] = $this->services[$i]["duration"];
			$blank1["cost"] = $this->services[$i]["cost"];
			$blank1["cost_work"] = $this->services[$i]["cost_work"];
			$blank1["electricity"] = $this->services[$i]["electricity"];
			$tr .= $this->getReplaceTemplate($blank1, "service_table_tr");
		}
		$blank2["service_table_tr"] = $tr;
		$blank3 = $this->getReplaceTemplate($blank2, "service_table");
		$res["middle"] = $blank3;
		$res["title"] = "Список услуг";
		$res["form"] = $this->getTemplate("form_service");;
		return $this->getReplaceTemplate($res, "main");
	}
}
?>