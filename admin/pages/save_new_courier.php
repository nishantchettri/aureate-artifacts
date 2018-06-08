<?php
	session_start();
	require_once("../includes/check_permission.php");
	require("../../class/courier.class.php");

    if(isset($_POST["name"]) && isset($_POST['contact']) && isset($_POST["fee"])) {
		$courier_name = $_POST['name'];
		$contact = $_POST['contact'];
		$fee = $_POST['fee'];
		$courierDAO = new courier();
		$courierDAO->addCourier($courier_name, $contact, $fee);
	}
	header('location:courier.php');

?>
