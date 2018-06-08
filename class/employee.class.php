<?php
	require_once('connect.class.php');
	class employee
	{
		public function getMaxId($columnName, $tableName){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT max(".$columnName.") as max FROM ".$tableName);
			$qry->execute();
			return $qry;
		}
		
		public function viewEmployee()
		{
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("SELECT e.*, p.permission_level FROM employee e, permission p where e.permission_id = p.permission_id AND !ISNULL(employee_id)");
			$qry->execute();
			return $qry;
		}

        public function getEmployeeByID($employee_id) {
            $dbcon = new connect();
            $qry = $dbcon->db1->prepare("SELECT * FROM employee WHERE employee_id=:employee_id");
            $qry->bindParam(":employee_id", $employee_id, PDO::PARAM_INT);
            $qry->execute();
            return $qry;
        }
		
		public function getEmployeeByUsername($username) {
            $dbcon = new connect();
            $qry = $dbcon->db1->prepare("SELECT * FROM employee WHERE username=:username");
            $qry->bindParam(":username", $username, PDO::PARAM_STR);
            $qry->execute();
            return $qry;
        }

        public function updateEmployee($employee_id, $position, $salary, $permission){
            $dbcon = new connect();
            $qry = $dbcon->db1->prepare("UPDATE employee SET position=:position, salary=:salary, permission_id=:permission WHERE employee_id=:employee_id");
            $qry->bindParam(":position", $position, PDO::PARAM_STR);
            $qry->bindParam(":salary", $salary, PDO::PARAM_STR);
            $qry->bindParam(":permission", $permission, PDO::PARAM_INT);
            $qry->bindParam(":employee_id", $employee_id, PDO::PARAM_INT);
            $qry->execute();
			return $qry;
        }
		
		public function updateEmployeeProfile($employee_id, $fname, $lname, $position, $salary, $username, $password, $permission_id, $salt) {
            $dbcon = new connect();
            $qry = $dbcon->db1->prepare("UPDATE employee SET fname=:fname, lname=:lname, position=:position, salary=:salary, username=:username, password=:password, permission_id=:permission_id, salt=:salt WHERE employee_id=:employee_id");
            $qry->bindParam(":fname", $fname, PDO::PARAM_STR);
            $qry->bindParam(":lname", $lname, PDO::PARAM_STR);
            $qry->bindParam(":position", $position, PDO::PARAM_STR);
            $qry->bindParam(":salary", $salary, PDO::PARAM_STR);
            $qry->bindParam(":username", $username, PDO::PARAM_STR);
            $qry->bindParam(":password", $password, PDO::PARAM_STR);
            $qry->bindParam(":permission_id", $permission_id, PDO::PARAM_INT);
            $qry->bindParam(":salt", $salt, PDO::PARAM_STR);
            $qry->bindParam(":employee_id", $employee_id, PDO::PARAM_INT);
            $qry->execute();
			return $qry;
        }

		public function updateEmployeePassword($employee_id, $password, $salt) {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("UPDATE employee SET password=:password, salt=:salt WHERE employee_id=:employee_id");
			$qry->bindParam(":password", $password, PDO::PARAM_STR);
			$qry->bindParam(":salt", $salt, PDO::PARAM_STR);
			$qry->bindParam(":employee_id", $employee_id, PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		
		public function addEmployee($fname, $lname, $position, $salary, $username, $password, $salt, $permission) {
			$maxId = $this->getMaxId("employee_id", "employee")->fetch();
			$employee_id = $maxId['max'] + 1;
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("INSERT INTO employee (employee_id, fname, lname, position, salary, username, password, salt, permission_id) VALUES (:employee_id, :fname, :lname, :position, :salary, :username, :password, :salt, :permission)");
			$qry->bindParam(":employee_id", $employee_id);
			$qry->bindParam(":fname", $fname);
			$qry->bindParam(":lname", $lname);
			$qry->bindParam(":position", $position);
			$qry->bindParam(":salary", $salary);
			$qry->bindParam(":username", $username);
			$qry->bindParam(":password", $password);
			$qry->bindParam(":salt", $salt);
			$qry->bindParam(":permission", $permission);
			$qry->execute();
			$arr = array();
			array_push($arr, $qry);
			array_push($arr, $employee_id);
			return $arr;
		}
	}

?>
