<?php
	mb_internal_encoding("UTF-8");
	require_once "classes/database_class.php";
	require_once "classes/frontpagecontent_class.php";
	require_once "classes/clientpagecontent_class.php";
	require_once "classes/workerpagecontent_class.php";
	require_once "classes/servicepagecontent_class.php";
	require_once "classes/consumablespagecontent_class.php";
	require_once "classes/equipmentpagecontent_class.php";
	require_once "classes/notfoundcontent_class.php";
	
	$db = new DataBase();
	$view = $_GET["view"];
	switch ($view) {
		case "": 
			$content = new FrontPageContent($db);
			break;
		case "client": 
			$content = new ClientPageContent($db);
			break;
		case "worker": 
			$content = new WorkerPageContent($db);
			break;
		case "service": 
			$content = new ServicePageContent($db);
			break;	
		case "consumables": 
			$content = new ConsumablesPageContent($db);
			break;	
		case "equipment": 
			$content = new EquipmentPageContent($db);
			break;	
		default: $content = new NotFoundContent($db);
	}
	
	echo $content->getContent();
?>