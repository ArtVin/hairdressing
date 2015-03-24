<?php
require_once "modules_class.php";

class EquipmentPageContent extends Modules {
	
	private $equipments;
	
	public function __construct($db) {
		parent::__construct($db);
		$this->equipments = $this->equipment->getAllOnDate();
	}
	
	protected function getMiddle() {
		$x = 1;
		for ($i = 0; $i < count($this->equipments); $i++) {
			if ($x == 1) {
				$blank1["color_row"] = "white_row";
				$x = 0;
			} else {
				$blank1["color_row"] = "black_row";
				$x = 1;
			}
			$blank1["id"] = $this->equipments[$i]["id"];
			$blank1["name"] = $this->equipments[$i]["name"];
			$blank1["serviceability"] = $this->equipments[$i]["serviceability"];
			$blank1["cost"] = $this->equipments[$i]["cost"];
			$tr .= $this->getReplaceTemplate($blank1, "equipment_table_tr");
		}
		$blank2["equipment_table_tr"] = $tr;
		$blank3 = $this->getReplaceTemplate($blank2, "equipment_table");
		$res["middle"] = $blank3;
		$res["title"] = "Список оборудования";
		$res["form"] = $this->getTemplate("form_equipment");;
		return $this->getReplaceTemplate($res, "main");
	}
}
?>