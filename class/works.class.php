<?php
	require_once('connect.class.php');
	class works
	{
		public function getMaxId($columnName, $tableName){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT max(".$columnName.") as max FROM ".$tableName);
			$qry->execute();
			return $qry;
		}
		
		public function getCurrentStore($employee_id){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("select * from works where employee_id = :employee_id HAVING max(work_date)");
			$qry->bindParam(":employee_id",$employee_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		
		public function insertWorkHistory($employee_id, $store_id, $work_date){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO works VALUES (:employee_id, :store_id, :work_date)");
			$qry->bindParam(":store_id",$store_id,PDO::PARAM_INT);
			$qry->bindParam(":employee_id",$employee_id,PDO::PARAM_INT);
			$qry->bindParam(":work_date",$work_date,PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
		
		public function updateWorkHistory($employee_id, $store_id, $work_date){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("UPDATE works SET work_date = :work_date, store_id = :store_id WHERE employee_id = :employee_id");
			$qry->bindParam(":employee_id",$employee_id,PDO::PARAM_INT);
			$qry->bindParam(":store_id",$store_id,PDO::PARAM_INT);
			$qry->bindParam(":work_date",$work_date,PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
	}

?>