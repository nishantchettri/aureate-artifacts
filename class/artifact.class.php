<?php
	require_once('connect.class.php');
	class artifact
	{
		public function getMaxId($columnName, $tableName){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT max(".$columnName.") as max FROM ".$tableName);
			$qry->execute();
			return $qry;
		}
		
		public function getAllArtifacts()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM artifact");
			$qry->execute();
			return $qry;
		}
		
		public function getArtifactByID($artifact_id)
		{
			$dbcon= new connect();
			$qry= $dbcon->db1->prepare("SELECT * FROM artifact WHERE artifact_id=:artifact_id");
			$qry->bindParam(":artifact_id",$artifact_id, PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}

		public function updateArtifact($artifact_id, $title, $description, $retail_price) {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("UPDATE artifact SET title=:title, description=:description, retail_price=:retail_price WHERE artifact_id=:artifact_id");
			$qry->bindParam(":title", $title);
			$qry->bindParam(":description", $description);
			$qry->bindParam(":retail_price", $retail_price);
			$qry->bindParam(":artifact_id", $artifact_id);
			$qry->execute();
			return $qry;
		}
		
		public function deleteArtifact($artifact_id) {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("DELETE FROM artifact WHERE artifact_id=:artifact_id");
			$qry->bindParam(":artifact_id", $artifact_id);
			$qry->execute();
			return $qry;
		}		

		public function addArtifact($title, $description, $retail_price, $type) {
			$maxId = $this->getMaxId("artifact_id", "artifact")->fetch();
			$artifact_id = $maxId['max'] + 1;
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("INSERT INTO artifact (artifact_id, title, description, retail_price, artifact_type) VALUES (:artifact_id, :title, :description, :retail_price, :type)");
			$qry->bindParam(":artifact_id", $artifact_id);
			$qry->bindParam(":title", $title);
			$qry->bindParam(":description", $description);
			$qry->bindParam(":retail_price", $retail_price);
			$qry->bindParam(":type", $type);
			$qry->execute();
			return $qry;
		}
	}

?>
