<?php
	session_start();
	require("../../class/courier.class.php");
	require_once("../includes/check_permission.php");
	
    if(!isset($_POST["name"]) || !isset($_POST['contact']) || !isset($_POST["fee"])) {
		header("Location: courier.php");
    }

	$courier_name = $_POST['name'];
	$courierDAO = new courier();
	
	if(isset($_POST['save'])){
		$contact = $_POST['contact'];
		$fee = $_POST['fee'];
		$courierDAO->updateCourier($courier_name, $contact, $fee);	
	} else if (isset($_POST['delete'])){
		$courierDAO->deleteCourier($courier_name);
	}
	
	header('location:courier.php');

?>
