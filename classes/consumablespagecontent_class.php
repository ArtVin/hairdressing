<?php
require_once "modules_class.php";

class ConsumablesPageContent extends Modules {
	
	private $consumables;
	
	public function __construct($db) {
		parent::__construct($db);
		$this->consumables = $this->consumable->getAllOnDate();
	}
	
	protected function getMiddle() {
		$x = 1;
		for ($i = 0; $i < count($this->consumables); $i++) {
			if ($x == 1) {
				$blank1["color_row"] = "white_row";
				$x = 0;
			} else {
				$blank1["color_row"] = "black_row";
				$x = 1;
			}
			$blank1["id"] = $this->consumables[$i]["id"];
			$blank1["name"] = $this->consumables[$i]["name"];
			$blank1["count"] = $this->consumables[$i]["count"];
			$blank1["volume"] = $this->consumables[$i]["volume"];
			$blank1["cost"] = $this->consumables[$i]["cost"];
			$tr .= $this->getReplaceTemplate($blank1, "consumables_table_tr");
		}
		$blank2["consumables_table_tr"] = $tr;
		$blank3 = $this->getReplaceTemplate($blank2, "consumables_table");
		$res["middle"] = $blank3;
		$res["title"] = "Список расходных материалов";
		$res["form"] = $this->getTemplate("form_consumables");
		return $this->getReplaceTemplate($res, "main");
	}
}
?>