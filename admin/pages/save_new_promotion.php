<?php
	session_start();
	require_once("../includes/check_permission.php");
	require("../../class/promotions.class.php");

    if(isset($_POST["title"]) && isset($_POST['discount']) && isset($_POST["start_date"]) && isset($_POST["end_date"])) {
		$title = $_POST["title"];
		$discount = 1 - ($_POST["discount"] / 100);
		$start_date = $_POST["start_date"];
		$end_date = $_POST["end_date"];
		$description = $_POST["description"];
		
		$promotionDAO = new promotions();
		$promotionDAO->addPromotion($title, $discount, $start_date, $end_date, $description);
	}

	header('location:promotion.php');

?>
