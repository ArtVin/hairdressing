<?php
	require_once "classes/database_class.php";
	require_once "classes/manage_class.php";
	
	$db = new DataBase();
	$manage = new Manage($db);
	$config = array('new_order' => 'newOrder',
					'search' => 'search',
					'sorting' => 'sorting',
					'now' => 'now',
					'add_client' => 'addClient',
					'update_client' => 'updateClient',
					'delete_client' => 'deleteClient',
					'add_worker' => 'addWorker',
					'update_worker' => 'updateWorker',
					'delete_worker' => 'deleteWorker',
					'add_service' => 'addService',
					'update_service' => 'updateService',
					'delete_service' => 'deleteService',
					'add_consumables' => 'addConsumables',
					'update_consumables' => 'updateConsumables',
					'delete_consumables' => 'deleteConsumables',
					'add_equipment' => 'addEquipment',
					'update_equipment' => 'updateEquipment',
					'delete_equipment' => 'deleteEquipment',
					'report' => 'createReport'
					);
	
	foreach ($config as $key => $method) {
		if ($_POST[$key]) {
			$r = $manage->$method();
			break;
		}	
	}
	
	$manage->redirect($r);
?>