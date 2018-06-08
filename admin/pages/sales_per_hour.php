<?php
	session_start();
	require_once("../../class/reports.class.php");
	require_once("../includes/check_permission.php");
	
	$reportsDAO = new reports();
	$reports = $reportsDAO->getSalesByHour()->fetchAll();
	
	$start_date = "";
	$end_date = "";
	if(isset($_POST['search'])){
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		if(!empty($start_date) && !empty($end_date)){
			$reports = $reportsDAO->filterSalesByHourByDate($start_date, $end_date)->fetchAll();
		}
	}
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Sales Per Hour</title>
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
                    <h1 class="page-header">Sales Per Hour</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<h4>Search by Date</h4>
			<form method="post" action="sales_per_hour.php">
				<div class="col-lg-4 charts-left">
					<div class="form-group">
						<input class="form-control" placeholder="Start Date (YYYY-MM-DD)" name="start_date" type="text" autofocus value="<?php echo $start_date ?>">
					</div>
				</div>
				<div class="col-lg-4 charts-center">
					<div class="form-group">
						<input class="form-control" placeholder="End Date (YYYY-MM-DD)" name="end_date" type="text" value="<?php echo $end_date ?>">
					</div>
				</div>
				<div class="col-lg-4 charts-right">
					<div>
						<button type="submit" class="btn btn-success" name="search">Search</button>
					</div>
				</div>
			</form>
			<!-- START CHARTS -->
            <div class="row">
				<!-- SALES BY ITEM -->
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							Sales Per Hour
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
                            <div id="morris-bar-chart"></div>
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
                            Hourly Listing
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <td>Time of Hour (24-hour)</td>
                                            <td>Total Sales</td>
                                            <td>Total Profit</td>
											<td>Total Quantity</td>
										</tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($reports as $report) {
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo $report["hour"] . " o'clock";
                                                    echo "</td>";
                                                    echo "<td>";
														$sale = $report['total_sale'];
														if(strcasecmp($sale,"") == 0){
															$sale = 0;
														}
                                                        echo $sale;
                                                    echo "</td>";
                                                    echo "<td>";
														$profit = $report['total_profit'];
														if(strcasecmp($profit,"") == 0){
															$profit = 0;
														}
                                                        echo $profit;
                                                    echo "</td>";
													echo "<td>";
														$qty = $report['total_quantity'];
														if(strcasecmp($qty,"") == 0){
															$qty = 0;
														}
                                                        echo $qty;
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
<script src="../bower_components/raphael/raphael-min.js"></script>
<script src="../bower_components/morrisjs/morris.min.js"></script>
<script>
	var labels = [];
	var rowList = [];
	var count = 0;
	$(".table thead tr td:not(:first-child)").each(function(){
		labels[count] = $(this).text();
		count++;
	});
	var count = 0;
	$(".table tbody tr").each(function(){
		var row = {};
		row['y'] = $(this).find('td:first').html();
		row['a'] = $(this).find('td:first').next().html();
		row['b'] = $(this).find('td:first').next().next().html();
		row['c'] = $(this).find('td:first').next().next().next().html();
		rowList[count] = row;
		count++;
	});
	
	$(function() {
		Morris.Bar({
			element: 'morris-bar-chart',
			data: rowList,
			xkey: 'y',
			ykeys: ['a', 'b', 'c'],
			labels: labels,
			hideHover: 'auto',
			resize: true
		});
	});

</script>
</body>

</html>
