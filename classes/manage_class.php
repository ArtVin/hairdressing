<?php
require_once "config_class.php";
require_once "order_class.php";
require_once "worker_class.php";
require_once "client_class.php";
require_once "service_class.php";
require_once "consumables_class.php";
require_once "equipment_class.php";
require_once "user_class.php";
require_once "fpdf/fpdf.php";

class Manage {
	
	private $config;
	private $user;
	private $order;
	private $worker;
	private $client;
	private $service;
	protected $consumable;
	protected $equipment;
	public $data;
	
	public function __construct($db) {
		session_start();
		$this->config = new Config();
		$this->order = new Order($db);
		$this->worker = new Worker($db);
		$this->user = new User($db);
		$this->client = new Client($db);
		$this->service = new Service($db);
		$this->consumable = new Consumables($db);
		$this->equipment = new Equipment($db);
		$this->data = $this->secureData(array_merge($_POST, $_GET));
	}
	
	private function secureData($data) {
		foreach($data as $key => $value) {
			if (is_array($value)) $this->secureData($value);
			else $data[$key] = htmlspecialchars($value);
		}
		return $data;
	}
	
	public function redirect($link) {
		header("Location: $link");
		exit;
	}
	
	public function search() {
		if ($this->data["search_date"] == "") $_SESSION["search_date"] = "";
		else $_SESSION["search_date"] = $this->data["search_date"];
		
		if ($this->data["worker"] == "") $_SESSION["search_worker"] = "";
		else $_SESSION["search_worker"] = $this->data["worker"];
		
		return $r = $this->config->adress."?view=";
	}
	
	public function sorting() {
		if ($this->data["sorting_data"] == "") $_SESSION["sorting_data"] = "";
		else $_SESSION["sorting_data"] = $this->data["sorting_data"];
		
		return $r = $this->config->adress."?view=client";
	}
		
	private function getListApplicant() {
		foreach ($this->data as $key => $value) {
			$array[$key] = $value;
		}
		array_shift($array);
		unset($array["field"]);
		unset($array["value"]);
		unset($array["id_up"]);
		unset($array["id_del"]);
		return $array;
	}
	
	public function newOrder() {
		$services = $this->service->getAllOnName($this->data["service"]);
		$clients = $this->client->getAllOnName($this->data["client"]);
		if ($this->data["length_hair"] == "короткие") $k = 1;
		elseif ($this->data["length_hair"] == "средние") $k = 1.25;
		else $k = 1.5;
		$total_cost = $k *($services[0]["cost"] + $services[0]["cost_work"]);
		$sale = $total_cost - $total_cost * $clients[0]["discount"] / 100;
		$array["id_worker"] = $this->worker->findID($this->data["worker2"]);
		$array["id_client"] = $this->client->findID($this->data["client"]);
		$array["id_service"] = $services[0]["id"];
		$array["length_hair"] = $this->data["length_hair"];
		$array["date"] = $this->data["date"];
		$array["time"] = $this->data["time"];
		$array["hours"] = $services[0]["duration"];
		$array["total_cost"] =  $total_cost;
		$this->order->addOrder($array);
		return $r = $this->config->adress."?view=";
	}
	
	public function now() {
		$_SESSION["search_date"] = "now";
		return $r = $this->config->adress."?view=";
	}
	
	public function addClient() {
		$array = $this->getListApplicant();
		array_shift($array);
		$error = 0;
		foreach ($array as $key => $value) {
			if ($value == '') $error = 1;
		}
		if ($error == 0) {
			
			$this->client->addClient($array);
			return $r = $this->config->adress."?view=client";
		}
		else return $r = $this->config->adress."?view=";
	}
	
	public function addWorker() {
		$array = $this->getListApplicant();
		$error = 0;
		foreach ($array as $key => $value) {
			if ($value == '') $error = 1;
		}
		if ($error == 0) {
			$this->worker->addWorker($array);
			return $r = $this->config->adress."?view=worker";
		}
		else return $r = $this->config->adress."?view=";
	}
	
	public function addService() {
		$array = $this->getListApplicant();
		
		$cost1 = $this->consumable->getCost($array["id_cons"]);
		$cost2 = $this->consumable->getCost($array["id_eq"]);
		if ($array["electricity"] == "+") $cost3 = 10;
		else $cost3 = 0;
		$array["cost"] = $cost1 + $cost2 + $cost3;
		
		$this->service->addService($array);
		return $r = $this->config->adress."?view=service";
	}
	
	public function addConsumables() {
		$array = $this->getListApplicant();
		$error = 0;
		foreach ($array as $key => $value) {
			if ($value == '') $error = 1;
		}
		if ($error == 0) {
			$this->consumable->addConsumables($array);
			return $r = $this->config->adress."?view=consumables";
		}
		else return $r = $this->config->adress."?view=";
	}
	
	public function addEquipment() {
		$array = $this->getListApplicant();
		$error = 0;
		foreach ($array as $key => $value) {
			if ($value == '') $error = 1;
		}
		if ($error == 0) {
			$this->equipment->addEquipment($array);
			return $r = $this->config->adress."?view=equipment";
		}
		else return $r = $this->config->adress."?view=";
	}
	
	public function updateClient() {
		$id = $this->data["id_up"];
		$field = $this->data["field"];
		$value = $this->data["value"];
		$this->client->updateClient($id, $field, $value);
		return $r = $this->config->adress."?view=client";
	}
	
	public function updateWorker() {
		$id = $this->data["id_up"];
		$field = $this->data["field"];
		$value = $this->data["value"];
		$this->worker->updateWorker($id, $field, $value);
		return $r = $this->config->adress."?view=worker";
	}
	
	public function updateService() {
		$id = $this->data["id_up"];
		$field = $this->data["field"];
		$value = $this->data["value"];
		$this->service->updateService($id, $field, $value);
		return $r = $this->config->adress."?view=service";
	}
	
	public function updateConsumables() {
		$id = $this->data["id_up"];
		$field = $this->data["field"];
		$value = $this->data["value"];
		$this->consumable->updateConsumables($id, $field, $value);
		return $r = $this->config->adress."?view=consumables";
	}
	
	public function updateEquipment() {
		$id = $this->data["id_up"];
		$field = $this->data["field"];
		$value = $this->data["value"];
		$this->equipment->updateEquipment($id, $field, $value);
		return $r = $this->config->adress."?view=equipment";
	}
	
	public function deleteClient() {
		$id = $this->data["id_del"];
		$this->client->deleteClient($id);
		return $r = $this->config->adress."?view=client";
	}
	
	public function deleteWorker() {
		$id = $this->data["id_del"];
		$this->worker->deleteWorker($id);
		return $r = $this->config->adress."?view=worker";
	}
	
	public function deleteService() {
		$id = $this->data["id_del"];
		$this->service->deleteService($id);
		return $r = $this->config->adress."?view=service";
	}
	
	public function deleteConsumables() {
		$id = $this->data["id_del"];
		$this->consumable->deleteConsumables($id);
		return $r = $this->config->adress."?view=consumables";
	}
	
	public function deleteEquipment() {
		$id = $this->data["id_del"];
		$this->equipment->deleteEquipment($id);
		return $r = $this->config->adress."?view=equipment";
	}
	
	public function createReport() {
		$textColour = array( 0, 0, 0 );
		$tableBorderColour = array( 50, 50, 50 );
		$tableFillColour = array( 255, 255, 255 );
		//$this->order->query1()
		$pdf = new FPDF( 'P', 'mm', 'A4' );
		$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
		$pdf->AddPage();
		$pdf->AddFont('TimesNewRomanPSMT','B','times.php');
		$pdf->SetFont('TimesNewRomanPSMT','B',18);
		$pdf->Cell( 0, 15, "Отчет по работе ЧП", 0, 0, 'C' );
		$pdf->SetFont('TimesNewRomanPSMT','B',14);
		$pdf->Ln( 16 );
		$pdf->Write( 6, "Список работников");
		$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
		$pdf->SetFillColor( $tableFillColour[0], $tableFillColour[1], $tableFillColour[2] );
		$pdf->Ln( 16 );
		$pdf->Cell( 10, 12, "id", 1, 0, 'L', true );
		$pdf->Cell( 26, 12, "Фамилия", 1, 0, 'L', true );
		$pdf->Cell( 26, 12, "Имя", 1, 0, 'L', true );
		$pdf->Cell( 26, 12, "Отчество", 1, 0, 'L', true );
		$pdf->Cell( 26, 12, "День рождения", 1, 0, 'L', true );
		$pdf->Cell( 26, 12, "Должность", 1, 0, 'L', true );
		$pdf->Cell( 26, 12, "Опыт", 1, 0, 'L', true );
		$pdf->Cell( 26, 12, "Навык", 1, 0, 'L', true );
		$pdf->Ln( 12 );
		$workers = $this->worker->getAllOnDate();
		for ($i = 0; $i < count($workers); $i++) {
			$pdf->Cell( 10, 12, $workers[$i]["id"], 1, 0, 'L', true );
			$pdf->Cell( 26, 12, $workers[$i]["surname"], 1, 0, 'L', true );
			$pdf->Cell( 26, 12, $workers[$i]["name"], 1, 0, 'L', true );
			$pdf->Cell( 26, 12, $workers[$i]["patronymic"], 1, 0, 'L', true );
			$pdf->Cell( 26, 12, $workers[$i]["birthday"], 1, 0, 'L', true );
			$pdf->Cell( 26, 12, $workers[$i]["post"], 1, 0, 'L', true );
			$pdf->Cell( 26, 12, $workers[$i]["experience"], 1, 0, 'L', true );
			$pdf->Cell( 26, 12, $workers[$i]["skill"], 1, 0, 'L', true );
			$pdf->Ln( 12 );
		}
		$pdf->Output( "report.pdf", "I" );
		return $r = $this->config->adress."?view=";
	}
}	
?>