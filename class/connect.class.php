<?php
	include_once('/../config.php');
	class connect{
		public $db1;
		public function __construct()
		{
			try
			{
				require(__DIR__ . '/../config.php');
				$this->db1 = new PDO('mysql:host='.$dbAddress.';port=3306;dbname='.$db, $dbUsername, $dbPassword);
				//Change the dbname value according to what you have named the database. localhost connection like mysql connect.
			}
			catch (PDOException $ex)
			{
				echo 'Connection failed: ' . $ex->getMessage();
			}
		}
	}
?>
