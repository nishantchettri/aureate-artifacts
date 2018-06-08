<?php
	session_start();
	require_once("../includes/check_permission.php");
	require("../../class/store.class.php");
	require("../../class/address.class.php");

    if(!isset($_POST["name"]) 
		|| !isset($_POST['store_type']) 
			|| (isset($_POST['store_type']) && strcasecmp($_POST['store_type'],"0") == 0)) {
		header("location: store.php");
    } else {
		// address
		$addr_street1 = $_POST["addr1"];
		$addr_street2 = $_POST["addr2"];
		$city = $_POST["city"];
		$state = $_POST["state"];
		$country = $_POST["country"];
		$postcode = $_POST["postcode"];
		
		$addressDAO = new address();
		$addressInfo = $addressDAO->insertAdddress($addr_street1, $addr_street2, $city, $state, $country, $postcode);
		$qry = $addressInfo[0];
		$address_id = $addressInfo[1];
		if($qry->rowCount() > 0){
			$name = $_POST["name"];
			$type = $_POST["store_type"];
			$storeDAO = new store();
			$storeVal = $storeDAO->insertStore($name, $address_id, $type);
			if ($storeVal->rowCount() == 0){
				$addressDAO = new address();
				$addressInfo = $addressDAO->deleteAddress($address_id);
			} 
			header('location:store.php');
		}
	}

?>
