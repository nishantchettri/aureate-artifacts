<?php
	session_start();
	require_once('../../class/connect.class.php');
	require_once("../../class/reports.class.php");
	require_once("../includes/check_permission.php");
	
	$reportsDAO = new reports();
	$reports = $reportsDAO->getSalesByEmployee()->fetchAll();

	
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Sales By Employee</title>
	<style>
		.charts-left{
			padding-left:0;	
		}
		.charts-center{
			padding-left:0;
			padding-right:0;
		}
		.charts-right{
			padding-right:0;
		}
	</style>
</head>

<body>
    <div id="wrapper">
        <?php require('../includes/navbar.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sales By Employee</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row 
			<h4>Search by Date</h4>
			<form method="post" action="sales_by_location.php">
				<div class="col-lg-4 charts-left">
					<div class="form-group">
						<input class="form-control" placeholder="Start Date (YYYY-MM-DD)" name="start_date" type="text" autofocus>
					</div>
				</div>
				<div class="col-lg-4 charts-center">
					<div class="form-group">
						<input class="form-control" placeholder="End Date (YYYY-MM-DD)" name="end_date" type="text" autofocus>
					</div>
				</div>
				<div class="col-lg-4 charts-right">
					<div>
						<button type="submit" class="btn btn-success" name="search">Search</button>
					</div>
				</div>
			</form>-->
			<!-- START CHARTS -->
            <div class="row">
				<!-- SALES BY ITEM TYPE-->
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							Total Sales
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div class="flot-chart">
								<div class="flot-chart-content" id="flot-pie-chart-sales"></div>
							</div>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
			</div>
			<!-- END CHARTS -->
			<!-- START TABLE -->
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Employee Listing
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <td>
                                                Employee ID
                                            </td>
                                            <td>
                                                Employee Name
                                            </td>
                                            <td>
                                                Total Sales
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($reports as $report) {
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo $report["employee_id"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $report["fname"];
                                                    echo "</td>";
                                                    echo "<td>";
														$total_sales = $report["total_sales"];
														if (strcasecmp($total_sales,"")==0){
															$total_sales = 0;
														}
                                                        echo $total_sales;
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
						<!-- /.panel -->
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

<!-- Flot Charts JavaScript -->
<script src="../bower_components/flot/excanvas.min.js"></script>
<script src="../bower_components/flot/jquery.flot.js"></script>
<script src="../bower_components/flot/jquery.flot.pie.js"></script>
<script src="../bower_components/flot/jquery.flot.resize.js"></script>
<script src="../bower_components/flot/jquery.flot.time.js"></script>
<script src="../bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script>
$(function() {
	var labels = [];
	var purchased = [];
	var count = 0;
	$(".table tbody tr").each(function(){
		var label = $(this).find('td:first').next().html();
		var purchase = $(this).find('td:first').next().next().html();
		labels[count] = label;
		purchased[count] = purchase;			
		count++;
	})
	
	var objList = [];
	
	for(var i=0; i<labels.length; i++){
		var obj = {};
		obj['label'] = labels[i];
		obj['data'] = purchased[i];
		objList[i] = obj;
	}
	
	var data = objList;

	var plotObj = $.plot($("#flot-pie-chart-sales"), data, {
		series: {
			pie: {
				show: true
			}
		},
		grid: {
			hoverable: true
		},
		tooltip: true,
		tooltipOpts: {
			content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
			shifts: {
				x: 20,
				y: 0
			},
			defaultTheme: false
		}
	});

});

$(function() {
	var labels = [];
	var purchased = [];
	var count = 0;
	$(".table tbody tr").each(function(){
		var label = $(this).find('td:first').html();
		var purchase = $(this).find('td:first').next().next().html();
		labels[count] = label;
		purchased[count] = purchase;			
		count++;
	})
	
	var objList = [];
	
	for(var i=0; i<labels.length; i++){
		var obj = {};
		obj['label'] = labels[i];
		obj['data'] = purchased[i];
		objList[i] = obj;
	}
	
	var data = objList;

	var plotObj = $.plot($("#flot-pie-chart-profit"), data, {
		series: {
			pie: {
				show: true
			}
		},
		grid: {
			hoverable: true
		},
		tooltip: true,
		tooltipOpts: {
			content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
			shifts: {
				x: 20,
				y: 0
			},
			defaultTheme: false
		}
	});

});
</script>
</body>

</html>
