<?php
require_once "modules_class.php";

class ClientPageContent extends Modules {
	
	private $clients;
	
	public function __construct($db) {
		parent::__construct($db);
		$this->clients = $this->client->getAllOnDate($this->sorting());
	}
	
	private function sorting() {
		if($_SESSION["sorting_data"] == "") $data_sort = "id";
		else $data_sort = $_SESSION["sorting_data"];
		return $data_sort;
	}
	
	protected function getMiddle() {
		$x = 1;
		for ($i = 0; $i < count($this->clients); $i++) {
			if ($x == 1) {
				$blank1["color_row"] = "white_row";
				$x = 0;
			} else {
				$blank1["color_row"] = "black_row";
				$x = 1;
			}
			$blank1["id"] = $this->clients[$i]["id"];
			$blank1["surname"] = $this->clients[$i]["surname"];
			$blank1["name"] = $this->clients[$i]["name"];
			$blank1["patronymic"] = $this->clients[$i]["patronymic"];
			$blank1["gender"] = $this->clients[$i]["gender"];
			$blank1["number"] = $this->clients[$i]["number"];
			$blank1["discount"] = $this->clients[$i]["discount"];
			$tr .= $this->getReplaceTemplate($blank1, "client_table_tr");
		}
		$blank2["client_table_tr"] = $tr;
		$blank3 = $this->getReplaceTemplate($blank2, "client_table");
		$res["middle"] = $blank3;
		$res["title"] = "Список клиентов";
		$res["form"] = $this->getTemplate("form_client");;
		return $this->getReplaceTemplate($res, "main");
	}
}
?>