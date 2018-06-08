<?php

    require('../../class/employee.class.php');

    $employee = new employee();

    $result = $employee->getEmployeeByUsername("CBXZero");

    if($result->rowCount() == 1) {
        $resultArray = $result->fetch();
        $employee_id = $resultArray['employee_id'];
        $password = $resultArray['password'];
        $salt = $resultArray['salt'];

        $newSalt = hash("sha256", strval(rand()));
        $saltedPassword = $password . $newSalt;
        $hashedSaltedPassword = hash("sha256", $saltedPassword);

        $employee->updateEmployeePassword($employee_id, $hashedSaltedPassword, $newSalt);
    }

 ?>
