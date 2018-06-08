<?php
	session_start();
    require("../../class/artifact.class.php");
	require_once("../includes/check_permission.php");

    if(isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["retail_price"])){
		$id = $_POST["id"];
		$artifactDAO = new artifact();
		if(isset($_POST['save'])){
			$title = $_POST["title"];
			$description = $_POST["description"];
			$retail_price = $_POST["retail_price"];
			$artifactDAO->updateArtifact($id, $title, $description, $retail_price);
		} else if(isset($_POST['delete'])){
			$artifactDAO->deleteArtifact($id);
		}
	}
	header("Location: artifact.php");

?>
