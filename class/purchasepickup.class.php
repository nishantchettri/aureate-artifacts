<?php
	require_once('connect.class.php');
	class purchasecustomize
	{
		public function getRequestByID($invoice_no, $artifact_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("select request from invoicepickup where invoice_no=:invoice_no and artifact_id=:artifact_id");
			$qry->bindParam(":invoice_no",$invoice_no,PDO::PARAM_INT);
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}	
		
		public function getAllOverdue(){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("select request from invoicepickup where now() > end_time");
			$qry->execute();
			return $qry;
		}
	}

?>