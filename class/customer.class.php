<?php
	require_once('connect.class.php');
	class customer
	{
		public function getMaxId($columnName, $tableName){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT max(".$columnName.") as max FROM ".$tableName);
			$qry->execute();
			return $qry;
		}
		
		public function getAllCustomers()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM customer");
			$qry->execute();
			return $qry;
		}

		public function selectCustomer($email)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM customer WHERE email=:email");
			$qry->bindParam(":email", $email, PDO::PARAM_STR);
			$qry->execute();
			return $qry;			
		}
		
		// Validate customer username and password
		public function checkCustomer($email, $password)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM customer c WHERE email=:email AND password=:password");
			$qry->bindParam(":email",$email,PDO::PARAM_STR);
			$qry->bindParam(":password",$password,PDO::PARAM_STR);
			$qry->execute();
			return $qry;			
		}
		
		// Get customer information by ID
		public function validateUser($email, $password)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM Customer WHERE email=:email");
			$qry->bindParam(":email",$email,PDO::PARAM_STR);
			$qry->execute();
			$res = $qry->fetch();
			$arr = array();
			$match = 0;
			if($res > 0){
				$db_pass = $res['password'];
				$salt = $res['salt'];
				$saltedPassword = $password . $salt;
				$convertedPassword = hash("sha256", $saltedPassword);
				if ($convertedPassword == $db_pass){
					$match = 1;
				}
			}
			array_push($arr,$match);
			array_push($arr,$res['customer_id']);
			return $arr;			
		}
		
		// Get customer information by email (username)
		public function getCustomerByEmail($email)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM customer c, address a WHERE email=:email AND c.addr_id = a.addr_id");
			$qry->bindParam(":email",$email,PDO::PARAM_STR);
			$qry->execute();
			return $qry;			
		}
		
		// Update customer contact information
		public function updateCustomer($email, $contact)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("UPDATE customer SET contact = :contact WHERE email = :email");
			$qry->bindParam(":contact",$contact,PDO::PARAM_STR);
			$qry->bindParam(":email",$email,PDO::PARAM_STR);
			$qry->execute();
			return $qry;			
		}
		
		// Change customer password
		public function changePassword($customer_id, $password, $salt){
			$dbcon = new connect();
			$qry=$dbcon->db1->prepare("UPDATE customer SET password=:password, salt=:salt WHERE customer_id=:customer_id");
			$qry->bindParam(":password",$password,PDO::PARAM_STR);
			$qry->bindParam(":salt",$salt,PDO::PARAM_STR);
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		
		// insert customer contact information
		public function insertCustomer($fname, $lname, $address_id, $contact, $email, $password, $salt){
			$maxId = $this->getMaxId("customer_id", "customer")->fetch();
			$customer_id = $maxId['max'] + 1;
			$dbcon = new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO Customer VALUES (:customer_id, :fname, :lname, :address_id, :contact, LCASE(:email), :password, :salt)");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->bindParam(":fname",$fname,PDO::PARAM_STR);
			$qry->bindParam(":lname",$lname,PDO::PARAM_STR);
			$qry->bindParam(":address_id",$address_id,PDO::PARAM_INT);
			$qry->bindParam(":contact",$contact,PDO::PARAM_INT);
			$qry->bindParam(":email",$email,PDO::PARAM_STR);
			$qry->bindParam(":password",$password,PDO::PARAM_STR);
			$qry->bindParam(":salt",$salt,PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
	}

?>
