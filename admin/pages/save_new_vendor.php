<?php
	session_start();
	require_once("../includes/check_permission.php");
	require("../../class/vendor.class.php");
	require("../../class/address.class.php");

    if(!isset($_POST["name"]) 
		|| !isset($_POST['contact'])) {
		header("location: vendor.php");
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
			$contact = $_POST["contact"];
			$vendorDAO = new vendor();
			$vendorVal = $vendorDAO->insertVendor($name, $address_id, $contact);
			if ($vendorVal->rowCount() == 0){
				$addressDAO = new address();
				$addressInfo = $addressDAO->deleteAddress($address_id);
			} 
			header('location:vendor.php');
		}
	}

?>
