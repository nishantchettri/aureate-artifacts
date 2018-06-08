<?php
	error_reporting(0);
	session_start();
	extract($_GET);
	extract($_POST);
	
	if(!isset($_SESSION['username']) || !isset($_SESSION['customer_id'])){
		header('location:index.php');
	}

?>