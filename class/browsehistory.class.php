<?php
	require_once('connect.class.php');
	class browsehistory
	{
		public function addHistory($customer_id, $artifact_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO browsehistory VALUES (:customer_id, :artifact_id, now())");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}	
	}

?>