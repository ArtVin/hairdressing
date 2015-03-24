<?php
require_once "config_class.php";
require_once "order_class.php";
require_once "client_class.php";
require_once "service_class.php";
require_once "worker_class.php";
require_once "consumables_class.php";
require_once "equipment_class.php";
require_once "user_class.php";

abstract class Modules {
	
	protected $config;
	protected $order;
	protected $client;
	protected $service;
	protected $worker;
	protected $consumable;
	protected $equipment;
	protected $user;
	protected $user_info;
	
	public function __construct($db) {
		session_start();
		$this->config = new Config();
		$this->order = new Order($db);
		$this->client = new Client($db);
		$this->user = new User($db);
		$this->worker = new Worker($db);
		$this->service = new Service($db);
		$this->consumable = new Consumables($db);
		$this->equipment = new Equipment($db);
		$this->user_info = $this->getUser();
	}
	
	private function getUser() {
		$login = $_SESSION["login"];
		$password = $_SESSION["password"];
		if ($this->user->checkUser($login, $password)) return $this->user->getUserOnLogin($login);
		else return false;
	}
	
	public function getContent() {
		return $this->getMiddle();
	}
	
	abstract protected function getMiddle();
	
	protected function getAge($str) {
		$month = substr($str, 3, 2);
		$day = substr($str, 0, 2);
		$year = substr($str, 6, 4);
		if (substr($month, 0, 1) == "0") $month = substr($month, 1, 1);
		if (substr($day, 0, 1) == "0") $day = substr($day, 1, 1);
		$age = (int)((time() - mktime(0, 0, 0, $month, $day, $year))/31536000);
		return $age;
	}
	
	public function getTemplate($name) {
		$text = file_get_contents($this->config->dir_tmpl.$name.".tpl");
		return str_replace("%adress%", $this->config->adress, $text);
	}
	
	protected function getReplaceTemplate($sr, $template) {
		return $this->getReplaceContent($sr, $this->getTemplate($template));
	}
	
	private function getReplaceContent($sr, $content) {
		$search = array();
		$replace = array();
		$i = 0;
		foreach ($sr as $key => $value) {
			$search[$i] = "%$key%";
			$replace[$i] = $value;
			$i++;
		}
		return str_replace($search, $replace, $content);
	}
	
	// protected function redirect($link) {
		// header("Location: $link");
		// exit;
	// }
}
?>