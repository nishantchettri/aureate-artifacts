<?php
	require_once('connect.class.php');
	class courier
	{
		public function getAllCouriers()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM courier");
			$qry->execute();
			return $qry;			
		}
		
		public function getCourierByName($courier_name){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM courier WHERE courier_name = :courier_name");
			$qry->bindParam(":courier_name",$courier_name, PDO::PARAM_STR);
			$qry->execute();
			return $qry;	
		}
		
		public function addCourier($courier_name, $contact, $fee){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO courier VALUES (:courier_name, :contact, :fee)");
			$qry->bindParam(":courier_name",$courier_name, PDO::PARAM_STR);
			$qry->bindParam(":contact",$contact, PDO::PARAM_STR);
			$qry->bindParam(":fee",$fee, PDO::PARAM_STR);
			$qry->execute();
			return $qry;	
		}
		
		public function updateCourier($courier_name, $contact, $fee){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("UPDATE courier SET contact = :contact, fee = :fee WHERE courier_name = :courier_name");
			$qry->bindParam(":courier_name",$courier_name, PDO::PARAM_STR);
			$qry->bindParam(":contact",$contact, PDO::PARAM_STR);
			$qry->bindParam(":fee",$fee, PDO::PARAM_STR);
			$qry->execute();
			return $qry;	
		}
		
		public function deleteCourier($courier_name){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("DELETE FROM courier WHERE courier_name = :courier_name");
			$qry->bindParam(":courier_name",$courier_name, PDO::PARAM_STR);
			$qry->execute();
			return $qry;	
		}
	}

?>