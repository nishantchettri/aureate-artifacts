<?php
	session_start();
	require_once("../includes/check_permission.php");	
	require("../../class/artifact.class.php");

    if(isset($_POST["title"]) && isset($_POST['artifact_type']) && isset($_POST["retail_price"])) {
		$art_type = $_POST['artifact_type'];
		if(strcasecmp($art_type,"0") !== 0){
			$title = $_POST["title"];
			$description = $_POST["description"];
			$retail_price = $_POST["retail_price"];
			$artifactDAO = new artifact();
			$artifactDAO->addArtifact($title, $description, $retail_price, $art_type);
		}
	}
	header('location:artifact.php');

?>
