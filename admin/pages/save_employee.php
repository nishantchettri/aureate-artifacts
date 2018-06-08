<?php
	session_start();
	require_once("../includes/check_permission.php");
	require("../../class/employee.class.php");
	require("../../class/works.class.php");

    if(isset($_POST["id"]) && isset($_POST["fname"]) && isset($_POST['lname']) && isset($_POST["position"]) && strcasecmp($_POST['position'],"0") !==0 && isset($_POST["permission"]) && strcasecmp($_POST['permission'],"0") !==0 && isset($_POST["store"]) && strcasecmp($_POST['store'],"0") !==0 && isset($_POST["start_date"]) && isset($_POST["salary"])  && isset($_POST["email"])) {
		$employee_id = $_POST['id'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$position = $_POST['position'];
		$permission = $_POST['permission'];
		$store = $_POST['store'];
		$start_date = $_POST['start_date'];
		$salary = $_POST['salary'];
		$email = $_POST['email'];
		
		if (strcasecmp($position,"0") !== 0 && strcasecmp($permission,"0") !== 0 && strcasecmp($store,"0") !== 0){
			$employeeDAO = new employee();
			$returnArray = $employeeDAO->updateEmployee($employee_id, $position, $salary, $permission);
			$worksDAO = new works();
			$worksDAO->updateWorkHistory($employee_id, $store, $start_date);
		} else {
			header('employee.php');
		}
		
	}
	header('location:employee.php');

?>
