<?php
	require_once('connect.class.php');
	class bowl
	{
		// Gets all bowls with titles from artifact table
		public function getAllBowls()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT distinct(a.title) as artifact_title,a.*, b.* FROM singingbowl b, artifact a where a.artifact_id = b.artifact_id");
			$qry->execute();
			return $qry;			
		}
		
		// Get bowl subclass records
		public function viewBowl()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM SingingBowl");
			$qry->execute();
			return $qry;			
		}
		
		// Gets bowl record from artifact table and subclass table by ID
		public function getBowlByID($artifact_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM Artifact a, SingingBowl s where s.artifact_id=a.artifact_id and s.artifact_id=:artifact_id");
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		
		// Get bowls by materials
		public function getBowlsByMaterial($material)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM SingingBowl where material=:material");
			$qry->bindParam(":material",$material,PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
		
		// Get bowls by weight
		public function getBowlsByWeight($weight)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM SingingBowl where weight>=:weight");
			$qry->bindParam(":weight",$weight,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
		
		// Get bowls by length
		public function getBowlsByLength($length)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM SingingBowl where length >= :length");
			$qry->bindParam(":length",$length,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}	
		public function getBowlWithName()
		{$dbcon= new connect();
			//$qry=$dbcon->db1->prepare("SELECT b.*,a.title FROM Bowl b, artifact a where b.artifact_id = a.artifact_id");
			$qry=$dbcon->db1->prepare("SELECT a.title FROM artifact a where artifact_type = 'Singing Bowl'");
			$qry->execute();
			return $qry;			
		}	
	}

?>