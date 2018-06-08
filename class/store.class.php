<?php
	require_once('connect.class.php');
	class store
	{
		public function getMaxId($columnName, $tableName){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT max(".$columnName.") as max FROM ".$tableName);
			$qry->execute();
			return $qry;
		}
		
		public function getAllStores()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM store");
			$qry->execute();
			return $qry;			
		}
		
		public function getStoreByID($store_id){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM store WHERE store_id = :store_id");
			$qry->bindParam(":store_id",$store_id, PDO::PARAM_INT);
			$qry->execute();
			return $qry;	
		}
		
		public function insertStore($store_name, $address_id, $store_type)
		{
			$maxId = $this->getMaxId("store_id", "store")->fetch();
			$store_id = $maxId['max'] + 1;
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO store VALUES (:store_id, :store_name, :addr_id, :store_type)");
			$qry->bindParam(":store_id",$store_id,PDO::PARAM_INT);
			$qry->bindParam(":store_name",$store_name,PDO::PARAM_STR);
			$qry->bindParam(":addr_id",$address_id,PDO::PARAM_INT);
			$qry->bindParam(":store_type",$store_type,PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
		
		public function updateStore($store_id, $store_name)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("UPDATE store SET store_name = :store_name WHERE store_id = :store_id");
			$qry->bindParam(":store_id",$store_id,PDO::PARAM_INT);
			$qry->bindParam(":store_name",$store_name,PDO::PARAM_STR);
			//$qry->bindParam(":store_type",$store_type,PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
		
		public function deleteStore($store_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("DELETE FROM store WHERE store_id = :store_id");
			$qry->bindParam(":store_id",$store_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
	}

?>