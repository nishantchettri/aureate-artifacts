<?php
	require_once('connect.class.php');
	class permission
	{
		public function getAllPermissions()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM permission");
			$qry->execute();
			return $qry;			
		}		
	}

?>