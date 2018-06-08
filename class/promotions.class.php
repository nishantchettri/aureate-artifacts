<?php
	require_once('connect.class.php');
	class promotions
	{
		public function getMaxId($columnName, $tableName){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT max(".$columnName.") as max FROM ".$tableName);
			$qry->execute();
			return $qry;
		}
		
		public function getAllPromotions()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM promotion");
			$qry->execute();
			return $qry;			
		}
		
		public function getAllValidPromotions()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM viw_validpromotionitem");
			$qry->execute();
			return $qry;			
		}

		public function hasPromotion($artifact_id){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("select * from viw_validpromotionitem where artifact_id = :artifact_id HAVING min(new_price)");
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		
		public function addPromotion($title, $discount, $start_time, $end_time, $description) {
			$maxId = $this->getMaxId("promotion_id", "promotion")->fetch();
			$promotion_id = $maxId['max'] + 1;
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("INSERT INTO promotion VALUES (:promotion_id, :title, :discount, :description, :start_time, :end_time)");
			$qry->bindParam(":promotion_id", $promotion_id);
			$qry->bindParam(":title", $title);
			$qry->bindParam(":discount", $discount);
			$qry->bindParam(":start_time", $start_time);
			$qry->bindParam(":end_time", $end_time);
			$qry->bindParam(":description", $description);
			$qry->execute();
			return $qry;
		}
		
		public function updatePromotion($id, $title, $discount, $start_time, $end_time, $description) {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("UPDATE promotion SET title = :title, discount = :discount, description = :description, start_time = :start_time, end_time = :end_time WHERE promotion_id = :promotion_id");
			$qry->bindParam(":promotion_id", $id);
			$qry->bindParam(":title", $title);
			$qry->bindParam(":discount", $discount);
			$qry->bindParam(":start_time", $start_time);
			$qry->bindParam(":end_time", $end_time);
			$qry->bindParam(":description", $description);
			$qry->execute();
			return $qry;
		}
		
		public function getPromotionsByID($promotion_id){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("select * from promotion p WHERE promotion_id = :promotion_id");
			$qry->bindParam(":promotion_id",$promotion_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		
		public function deletePromotionByID($promotion_id){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("DELETE from promotion WHERE promotion_id = :promotion_id");
			$qry->bindParam(":promotion_id",$promotion_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		
		
	}

?>