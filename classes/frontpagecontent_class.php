<?php
require_once "modules_class.php";

class FrontPageContent extends Modules {
	
	private $orders;
	private $workers;
	private $clients;
	private $services;
	private $s_date;
	
	public function __construct($db) {
		parent::__construct($db);
		$this->orders = $this->getSearch();
		$this->workers = $this->worker->getAllOnDate();
		$this->clients = $this->client->getAllOnSurname();
		$this->services = $this->service->getAllOnDate();
	}
	
	private function getSearch() {
		$s_date = $_SESSION["search_date"];
		$s_worker = $_SESSION["search_worker"];
		if ($s_date == "now") $data = $this->order->getAllOnDate($this->getNowDate());
		elseif (($s_date != "") && ($s_worker != "")) $data = $this->order->searchOnFields($s_date, $this->worker->findID($s_worker));
		elseif($s_date != "") $data = $this->order->getAllOnDate($s_date);
		elseif ($s_worker != "") $data = $this->order->getAllOnWorker($this->worker->findID($s_worker));
		
		return $data;
	}
	
	private function getNowDate() {
		$num = getdate(time());
		if (strlen($num["mday"]) == 1) $mday = "0".$num["mday"];
		if (strlen($num["mon"]) == 1) $mon = "0".$num["mon"];
		$date = $mday."-".$mon."-".$num["year"];
		return $date;
	}
	
	private function frontTable() {
		$array = array();
		$j = 0;
		for ($i = 0; $i < count($this->workers); $i++) {
			if ($this->workers[$i]["post"] == "парикмахер") {
				$array[$j]["surname"] = $this->workers[$i]["surname"];
				$array[$j]["name"] = $this->workers[$i]["name"];
				$array[$j]["patronymic"] = $this->workers[$i]["patronymic"];
				$j++;
			}
		}
		return $array;
	}
	
	private function searchListWorkers() {
		$front_table = $this->frontTable();
		for ($i = 0; $i < count($front_table); $i++) {
			$surname = $front_table[$i]["surname"];
			$name = substr($front_table[$i]["name"], 0, 2);
			$patronymic = substr($front_table[$i]["patronymic"], 0, 2);
			$blank1["name"] = $surname." ".$name.".".$patronymic.".";
			$option .= $this->getReplaceTemplate($blank1, "option");
		}
		$blank1["name"] = "";
		$option .= $this->getReplaceTemplate($blank1, "option");
		$blank2["name"] = "worker";
		$blank2["options"] = $option;
		$blank3 = $this->getReplaceTemplate($blank2, "select");
		return $blank3;
	}
	
	private function createListWorkers() {
		$front_table = $this->frontTable();
		for ($i = 0; $i < count($front_table); $i++) {
			$surname = $front_table[$i]["surname"];
			$name = substr($front_table[$i]["name"], 0, 2);
			$patronymic = substr($front_table[$i]["patronymic"], 0, 2);
			$blank1["name"] = $surname." ".$name.".".$patronymic.".";
			$option .= $this->getReplaceTemplate($blank1, "option");
		}
		$blank2["name"] = "worker2";
		$blank2["options"] = $option;
		$blank3 = $this->getReplaceTemplate($blank2, "select");
		return $blank3;
	}
	
	private function createListClients() {
		for ($i = 0; $i < count($this->clients); $i++) {
			$surname = $this->clients[$i]["surname"];
			$name = substr($this->clients[$i]["name"], 0, 2);
			$patronymic = substr($this->clients[$i]["patronymic"], 0, 2);
			$blank1["name"] = $surname." ".$name.".".$patronymic.".";
			$option .= $this->getReplaceTemplate($blank1, "option");
		}
		$blank2["options"] = $option;
		$blank2["name"] = "client";
		$blank3 = $this->getReplaceTemplate($blank2, "select");
		return $blank3;
	}
	
	private function createListServices() {
		for ($i = 0; $i < count($this->services); $i++) {
			$blank1["name"] = $this->services[$i]["name"];
			$option .= $this->getReplaceTemplate($blank1, "option");
		}
		$blank2["options"] = $option;
		$blank2["name"] = "service";
		$blank3 = $this->getReplaceTemplate($blank2, "select");
		return $blank3;
	}
	
	private function createForm() {
		$res["workers"] = $this->createListWorkers();
		$res["clients"] = $this->createListClients();
		$res["services"] = $this->createListServices();
		return $this->getReplaceTemplate($res, "form_order");
	}
	
	protected function getMiddle() {
		$x = 1;
		for ($i = 0; $i < count($this->orders); $i++) {
			if ($x == 1) {
				$blank1["color_row"] = "white_row";
				$x = 0;
			} else {
				$blank1["color_row"] = "black_row";
				$x = 1;
			}
			$blank1["id"] = $this->orders[$i]["id"];
			$blank1["id_worker"] = $this->orders[$i]["id_worker"];
			$blank1["id_client"] = $this->orders[$i]["id_client"];
			$blank1["id_service"] = $this->orders[$i]["id_service"];
			$blank1["length_hair"] = $this->orders[$i]["length_hair"];
			$blank1["date"] = $this->orders[$i]["date"];
			$blank1["time"] = $this->orders[$i]["time"];
			$blank1["hours"] = $this->orders[$i]["hours"];
			$blank1["total_cost"] = $this->orders[$i]["total_cost"];
			$tr .= $this->getReplaceTemplate($blank1, "main_table_tr");
		}
		$blank2["main_table_tr"] = $tr;
		$blank2["workers"] = $this->searchListWorkers();
		$blank3 = $this->getReplaceTemplate($blank2, "main_table");
		$res["middle"] = $blank3;
		$res["title"] = "Список заказов";
		$res["form"] = $this->createForm();
		return $this->getReplaceTemplate($res, "main");
	}
}
?>