<?php
	session_start();
	require_once("../includes/check_permission.php");
	require("../../class/store.class.php");
	require("../../class/address.class.php");

    if(!isset($_POST["sid"]) || 
		!isset($_POST["aid"]) ||
			!isset($_POST["name"]) || 
				!isset($_POST['store_type']) || 
					(isset($_POST['store_type']) && strcasecmp($_POST['store_type'],"0") == 0)) {
		header("Location: store.php");
    }

	$store_id = $_POST['sid'];
	$storeDAO = new store();
	
	if(isset($_POST['save'])){
		// address
		$addr_id = $_POST['aid'];
		$addr_street1 = $_POST["addr1"];
		$addr_street2 = $_POST["addr2"];
		$city = $_POST["city"];
		$state = $_POST["state"];
		$country = $_POST["country"];
		$postcode = $_POST["postcode"];
		$addressDAO = new address();
		$addressInfo = $addressDAO->updateAddress($addr_id, $addr_street1, $addr_street2, $city, $state, $country, $postcode);
		
		// Store
		$name = $_POST["name"];
		//$type = $_POST["store_type"];
		$storeDAO->updateStore($store_id, $name);
	} else if (isset($_POST['delete'])){
		$storeDAO->deleteStore($store_id);
	}
	
	header('location:store.php');

?>
