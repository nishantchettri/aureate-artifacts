<?php
	require_once('connect.class.php');
	class thangka
	{
		// Gets thangka title from artifact table
		public function getAllThangkas()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT distinct(a.title) as artifact_title,a.*, t.* FROM thangka t, artifact a where a.artifact_id = t.artifact_id");
			$qry->execute();
			return $qry;			
		}
		
		// Gets thangka information only from subclass
		public function getThangkas()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM Thangka where weight>='".$weight."'");
			/*SELECT * FROM Thangka where weight>='90'*/

			$qry=$dbcon->db1->prepare("SELECT * FROM Thangka");
			$qry->execute();
			return $qry;			
		}
		
		// Get thangka information by ID
		public function getThangkaByID($artifact_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM Artifact a, Thangka t where t.artifact_id=a.artifact_id and t.artifact_id=:artifact_id");
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		public function getThangkaWithName()
		{$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT t.*,a.title FROM Thangka t, artifact a where t.artifact_id = a.artifact_id");
			$qry->execute();
			return $qry;			
		}	
	
		/*public function addArtifact($patid, $aptreason, $aptdate, $apttime)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO artifact values ('', '$patid', '$aptreason', '$aptdate','$apttime')");
			return $qry;			
		}
	
		public function getThangkasByWeight($weight)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM Thangka where weight>=:weight");
			$qry->bindParam(":weight",$weight,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
		
		public function getThangkasByLength($length)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM Thangka where length >= :length");
			$qry->bindParam(":length",$length,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
		
		public function getThangkasByPainter($painter)
		{
			$dbcon = new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM Thangka where painter=:painter");
			$qry->bindParam(":painter",$painter,PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
		
		// $frame is boolean 0 or 1
		public function getThangkasByFrame($frame)
		{
			$dbcon = new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM Thangka where frame=:frame");
			$qry->bindParam(":frame",$painter,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}*/
	}
?>