<?php
	require_once('connect.class.php');
	class khukuri
	{
		public function getAllKhukuris()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT distinct(a.title) as artifact_title,a.*, k.* FROM khukuri k, artifact a where a.artifact_id = k.artifact_id");
			$qry->execute();
			return $qry;			
		}
		
		public function getKhukuriImage($artifact_id){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("select ai.image_path from artifactimagepath ai, khukuri k where k.artifact_id = :artifact_id and k.artifact_id = ai.artifact_id LIMIT 1");
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		
		public function getKhukuriByID($artifact_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM Artifact a, khukuri d where d.artifact_id=a.artifact_id and d.artifact_id = :artifact_id");
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		
		public function getKhukurisByWeight($weight)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM khukuri where weight>=:weight");
			$qry->bindParam(":weight",$weight,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
		
		public function getKhukurisByLength($length)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM Khukuri where length >= :length");
			$qry->bindParam(":length",$length,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}		
		public function getKhukuriWithName()
		{$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT k.*,a.title FROM Khukuri k, artifact a where k.artifact_id = a.artifact_id");
			$qry->execute();
			return $qry;			
		}		
	}

?>