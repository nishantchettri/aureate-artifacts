<?php
    session_start();
	
	include_once('../../class/purchasepickup.class.php');
	include_once('../../class/employee.class.php');
	include_once('../../class/artifact.class.php');
	include_once('../../class/invoice.class.php');
	include_once('../../class/customer.class.php');
	
	$employeeDAO = new employee();
	$totalEmp = $employeeDAO->viewEmployee();
	
	$artifactDAO = new artifact();
	$totalArt = $artifactDAO->getAllArtifacts();
	
	$invoiceDAO = new invoice();
	$totalInvoice = $invoiceDAO->viewInvoiceItemList();
	
	$customerDAO = new customer();
	$totalCustomers = $customerDAO->getAllCustomers();

	if(!isset($_SESSION["username"]) || !isset($_SESSION["permission_level"]) || $_SESSION['permission_level'] > 2) {
        header("Location:login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Dashboard</title>

</head>

<body>
    <div id="wrapper">
        <?php require('../includes/navbar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Welcome <?php //echo ", ".$_SESSION['username']; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-male fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $totalEmp->rowCount() ?></div>
                                    <div>Total Employees</div>
                                </div>
                            </div>
                        </div>
                        <a href="employee.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-paint-brush fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $totalArt->rowCount() ?></div>
                                    <div>Total Artifacts</div>
                                </div>
                            </div>
                        </div>
                        <a href="artifact.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $totalInvoice->rowCount() ?></div>
                                    <div>Total Purchases</div>
                                </div>
                            </div>
                        </div>
                        <a href="popular.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $totalCustomers->rowCount() ?></div>
                                    <div>Total Customers</div>
                                </div>
                            </div>
                        </div>
                        <a href="sales_by_location.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
