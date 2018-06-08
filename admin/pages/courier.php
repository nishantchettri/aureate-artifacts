<?php
	session_start();
	require_once('../../class/connect.class.php');
	require_once("../../class/courier.class.php");
	include_once('../includes/check_permission.php');
	
    $courierDao = new courier();
    $couriers = $courierDao->getAllcouriers()->fetchAll();


 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Courier Management</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Couriers <a href="add_courier.php"><button class="btn btn-default" type="button">Add Courier</button></a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Couriers
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <td>
                                                Name
                                            </td>
                                            <td>
                                                Added Service Charge
                                            </td>
                                            <td>
                                                Contact Info
                                            </td>
											<td>
												Action
											</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($couriers as $courier) {
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo $courier["courier_name"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $courier["fee"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $courier["contact"];
                                                    echo "</td>";
													echo "<td>";
                                                        echo  "<a href='edit_courier.php?name=".$courier["courier_name"]."'><button type='button' class='btn btn-default'>Edit</button></a>";
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

    <!-- jQuery -->
    <?php include_once('../includes/js.php'); ?>

</body>

</html>
