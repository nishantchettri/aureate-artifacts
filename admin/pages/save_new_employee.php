<?php
	session_start();
	require_once("../includes/check_permission.php");
	require("../../class/employee.class.php");
	require("../../class/works.class.php");

    if(isset($_POST["fname"]) && isset($_POST['lname']) && isset($_POST["position"]) && strcasecmp($_POST['position'],"0") !==0 && isset($_POST["permission"]) && strcasecmp($_POST['permission'],"0") !==0 && isset($_POST["store"]) && strcasecmp($_POST['store'],"0") !==0 && isset($_POST["start_date"]) && isset($_POST["salary"])  && isset($_POST["email"]) && isset($_POST["pass1"]) && isset($_POST["pass2"])) {
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$position = $_POST['position'];
		$permission = $_POST['permission'];
		$store = $_POST['store'];
		$start_date = $_POST['start_date'];
		$salary = $_POST['salary'];
		$email = $_POST['email'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		
		if (!empty($pass1) && !empty($pass2) && strcasecmp($pass1,$pass2) == 0 && strcasecmp($position,"0") !== 0 && strcasecmp($permission,"0") !== 0 && strcasecmp($store,"0") !== 0){
			$salt = hash("sha256", strval(rand()));
			$saltedPassword = $pass1 . $salt;
			$hashedSaltedPassword = hash("sha256", $saltedPassword);
			$employeeDAO = new employee();
			$returnArray = $employeeDAO->addEmployee($fname, $lname, $position, $salary, $email, $hashedSaltedPassword, $salt, $permission);
			$qry = $returnArray[0];
			$employee_id = $returnArray[1];
			if ($qry->rowCount() > 0){
				$worksDAO = new works();
				$worksDAO->insertWorkHistory($employee_id, $store, $start_date);
			}
		} else {
			header('employee.php');
		}
		
	}
	header('location:employee.php');

?>
