<?php
require_once "modules_class.php";

class WorkerPageContent extends Modules {
	
	private $workers;
	
	public function __construct($db) {
		parent::__construct($db);
		$this->workers = $this->worker->getAllOnDate();
	}
	
	protected function getMiddle() {
		$x = 1;
		for ($i = 0; $i < count($this->workers); $i++) {
			if ($x == 1) {
				$blank1["color_row"] = "white_row";
				$x = 0;
			} else {
				$blank1["color_row"] = "black_row";
				$x = 1;
			}
			$blank1["id"] = $this->workers[$i]["id"];
			$blank1["surname"] = $this->workers[$i]["surname"];
			$blank1["name"] = $this->workers[$i]["name"];
			$blank1["patronymic"] = $this->workers[$i]["patronymic"];
			$blank1["birthday"] = $this->workers[$i]["birthday"];
			$blank1["post"] = $this->workers[$i]["post"];
			$blank1["experience"] = $this->workers[$i]["experience"];
			$blank1["skill"] = $this->workers[$i]["skill"];
			$tr .= $this->getReplaceTemplate($blank1, "worker_table_tr");
		}
		$blank2["worker_table_tr"] = $tr;
		$blank3 = $this->getReplaceTemplate($blank2, "worker_table");
		$res["middle"] = $blank3;
		$res["title"] = "Список работников";
		$res["form"] = $this->getTemplate("form_worker");;
		return $this->getReplaceTemplate($res, "main");
	}
}
?>