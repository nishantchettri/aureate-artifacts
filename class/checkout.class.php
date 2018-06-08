<?php
	require_once('connect.class.php');
	class checkout
	{
		// For front end display
		public function getCartByID($customer_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("select a.*, a.retail_price, sci.*, (retail_price * quantity) as total
										from shoppingcartitem sci, artifact a 
										where customer_id=:customer_id 
										and sci.artifact_id = a.artifact_id ");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
		
		// Get records from checkout table to insert into invoice item
		public function getCartListByID($customer_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("select sci.*, a.retail_price from shoppingcartitem sci, artifact a 
										where sci.customer_id = :customer_id
										and sci.artifact_id = a.artifact_id");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
		
		public function insertCartItem($customer_id, $artifact_id, $qty, $request){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO shoppingcartitem VALUES (:customer_id, :artifact_id, :qty, :request)");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->bindParam(":qty",$qty,PDO::PARAM_INT);
			$qry->bindParam(":request",$request,PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
		
		public function updateCartItem($customer_id, $artifact_id, $qty){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("UPDATE shoppingcartitem 
										SET quantity = :qty 
										WHERE customer_id=:customer_id 
										AND artifact_id =  :artifact_id");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->bindParam(":qty",$qty,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		
		public function deleteCartItemByID($customer_id, $artifact_id){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("DELETE FROM shoppingcartitem
										WHERE customer_id=:customer_id
										AND artifact_id=:artifact_id");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
		
		public function deleteCartByID($customer_id){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("DELETE FROM shoppingcartitem
										WHERE customer_id=:customer_id");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
	}

?>