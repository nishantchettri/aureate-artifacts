<?php
	require_once('connect.class.php');
	class vendor
	{
		public function getAllVendors()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM vendor");
			$qry->execute();
			return $qry;			
		}
		
		public function getVendorByID($vendor_id){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM vendor WHERE vendor_id = :vendor_id");
			$qry->bindParam(":vendor_id",$vendor_id, PDO::PARAM_INT);
			$qry->execute();
			return $qry;	
		}
		
		public function getMaxId($columnName, $tableName){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT max(".$columnName.") as max FROM ".$tableName);
			$qry->execute();
			return $qry;
		}
		
		public function insertVendor($vendor_name, $address_id, $contact)
		{
			$maxId = $this->getMaxId("vendor_id", "vendor")->fetch();
			$vendor_id = $maxId['max'] + 1;
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO vendor VALUES (:vendor_id, :vendor_name, :contact, :addr_id)");
			$qry->bindParam(":vendor_id",$vendor_id,PDO::PARAM_INT);
			$qry->bindParam(":vendor_name",$vendor_name,PDO::PARAM_STR);
			$qry->bindParam(":addr_id",$address_id,PDO::PARAM_INT);
			$qry->bindParam(":contact",$contact,PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
		
		public function updateVendor($vendor_id, $vendor_name, $contact)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("UPDATE vendor SET vendor_name = :vendor_name, contact = :contact WHERE vendor_id = :vendor_id");
			$qry->bindParam(":vendor_id",$vendor_id,PDO::PARAM_INT);
			$qry->bindParam(":vendor_name",$vendor_name,PDO::PARAM_STR);
			$qry->bindParam(":contact",$contact,PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
		
		public function deleteVendor($vendor_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("DELETE FROM vendor WHERE vendor_id = :vendor_id");
			$qry->bindParam(":vendor_id",$vendor_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
	}

?>