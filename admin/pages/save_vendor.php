<?php
	session_start();
	require_once("../includes/check_permission.php");
	require("../../class/vendor.class.php");
	require("../../class/address.class.php");

    if(isset($_POST["vid"]) && isset($_POST["aid"]) && isset($_POST["name"]) && isset($_POST['contact'])){
		$vendor_id = $_POST['vid'];
		$vendorDAO = new vendor();
		
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
			
			// Vendor
			$name = $_POST["name"];
			$contact = $_POST["contact"];
			
			$vendorDAO->updateVendor($vendor_id, $name, $contact);
		} else if (isset($_POST['delete'])){
			$vendorDAO->deleteVendor($vendor_id);
		}
	}
	
	header('location:vendor.php');

?>
