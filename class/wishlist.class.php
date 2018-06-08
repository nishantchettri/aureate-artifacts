<?php
	require_once('connect.class.php');
	class wishlist
	{
		public function getWishlistByID($customer_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("select a.*, w.add_time from wishlist w, artifact a where w.customer_id =:customer_id and w.artifact_id = a.artifact_id");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
		
		public function deleteFromWishlist($customer_id, $artifact_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("DELETE FROM wishlist WHERE customer_id=:customer_id and artifact_id = :artifact_id");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
		
		public function insertIntoWishlist($customer_id, $artifact_id){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO wishlist VALUES (:customer_id, :artifact_id, now())");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
	}

?>