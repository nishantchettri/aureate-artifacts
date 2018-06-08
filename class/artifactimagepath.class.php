<?php
	require_once('connect.class.php');
	class artifactimagepath
	{
		public function getAllImages()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM artifactimagepath");
			$qry->execute();
			return $qry;			
		}
		public function getImageByID($artifact_id)
		{
			$dbcon= new connect();
			$qry= $dbcon->db1->prepare("Select * from artifactimagepath where artifact_id=:artifact_id LIMIT 1");
			$qry->bindParam(":artifact_id",$artifact_id, PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
	}

?>