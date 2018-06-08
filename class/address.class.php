<?php
	require_once('connect.class.php');
	class address
	{
		public function getMaxId($columnName, $tableName){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT max(".$columnName.") as max FROM ".$tableName);
			$qry->execute();
			return $qry;
		}
		
		public function getAddressByID($addr_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM address WHERE addr_id = :addr_id");
			$qry->bindParam(":addr_id",$addr_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
		
		public function updateAddress($addr_id, $addr1, $addr2, $city, $state, $country, $postcode)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("UPDATE address SET addr_street1 = :addr1, addr_street2 = :addr2, addr_city = :city, addr_state = :state, addr_country = :country, addr_postcode = :postcode WHERE addr_id=:addr_id");
			$qry->bindParam(":addr1",$addr1,PDO::PARAM_STR);
			$qry->bindParam(":addr2",$addr2,PDO::PARAM_STR);
			$qry->bindParam(":city",$city,PDO::PARAM_STR);
			$qry->bindParam(":state",$state,PDO::PARAM_STR);
			$qry->bindParam(":country",$country,PDO::PARAM_STR);
			$qry->bindParam(":postcode",$postcode,PDO::PARAM_STR);
			$qry->bindParam(":addr_id",$addr_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}	
		
		public function insertAdddress($addr_street1, $addr_street2, $addr_city, $addr_state, $addr_country, $addr_postcode)
		{
			$maxId = $this->getMaxId("addr_id", "address")->fetch();
			$addr_id = $maxId['max'] + 1;
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO address VALUES (:addr_id, :addr_street1, :addr_street2, :addr_city, :addr_state, :addr_country, :addr_postcode)");
			$qry->bindParam(":addr_id",$addr_id,PDO::PARAM_INT);
			$qry->bindParam(":addr_street1",$addr_street1,PDO::PARAM_STR);
			$qry->bindParam(":addr_street2",$addr_street2,PDO::PARAM_STR);
			$qry->bindParam(":addr_city",$addr_city,PDO::PARAM_STR);
			$qry->bindParam(":addr_state",$addr_state,PDO::PARAM_STR);
			$qry->bindParam(":addr_country",$addr_country,PDO::PARAM_STR);
			$qry->bindParam(":addr_postcode",$addr_postcode,PDO::PARAM_STR);
			$qry->execute();
			$arr = array();
			array_push($arr, $qry);
			array_push($arr, $addr_id);
			return $arr;			
		}	
		
		public function deleteAddress($address_id){
			$qry=$dbcon->db1->prepare("DELETE FROM address WHERE addr_id = :address_id");
			$qry->bindParam(":addr_id",$address_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
	}

?>