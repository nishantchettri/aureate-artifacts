<?php
	session_start();
	require_once('../../class/connect.class.php');
    require_once("../../class/employee.class.php");
	include_once('../includes/check_permission.php');
	
    $employeeDAO = new employee();
    $employees = $employeeDAO->viewEmployee()->fetchAll();


 ?>

<!DOCTYPE html>
<html lang="en">

<head>

   <?php include_once('../includes/css.php'); ?>
   <title>Employee Management</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Employees <a href="add_employee.php"><button class="btn btn-default" type="button">Add Employee</button></a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Employees
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <td>Name</td>
                                            <td>Position</td>
                                            <!--<td>Salary</td>-->
                                            <td>Username</td>
											<td>Permission</td>
											<td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($employees as $employee) {
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo $employee["fname"]." ".$employee["lname"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $employee["position"];
                                                    echo "</td>";
													echo "<td>";
                                                        echo $employee["username"];
                                                    echo "</td>";
													echo "<td>";
                                                        echo $employee["permission_level"];
													echo "</td>";
													echo "<td>";
                                                        echo  "<a href='edit_employee.php?id=".$employee["employee_id"]."'><button type='button' class='btn btn-default'>Edit</button></a>";
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include_once('../includes/js.php'); ?>

</body>

</html>
