<?php
	session_start();
	require_once('../../class/connect.class.php');
	require_once("../../class/reports.class.php");
	require_once("../includes/check_permission.php");
    $reportsDAO = new reports();
    $reports = $reportsDAO->getPopularArtifacts()->fetchAll();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Popular Reports</title>
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
                    <h1 class="page-header">Popular Artifacts</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<!-- START CHARTS -->
            <div class="row">
				<!-- MOST PURCHASED -->
				<div class="col-lg-4 ">
					<div class="panel panel-default">
						<div class="panel-heading">
							Most Purchased
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div class="flot-chart">
								<div class="flot-chart-content" id="flot-pie-chart-purchase"></div>
							</div>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
						
				<!-- MOST WISHLISTED -->
				<div class="col-lg-4 ">
					<div class="panel panel-default">
						<div class="panel-heading">
							Most Wishlisted
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div class="flot-chart">
								<div class="flot-chart-content" id="flot-pie-chart-wishlist"></div>
							</div>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
						
				<!-- MOST BROWSED -->
				<div class="col-lg-4 ">
					<div class="panel panel-default">
						<div class="panel-heading">
							Most Browsed
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div class="flot-chart">
								<div class="flot-chart-content" id="flot-pie-chart-browse"></div>
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
                            Artifacts Listing
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <td>
                                                Title
                                            </td>
                                            <td>
                                                Times Purchased
                                            </td>
                                            <td>
                                                Times Wishlisted
                                            </td>
											<td>
												Times Browsed
											</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($reports as $report) {
												echo "<tr>";
                                                    echo "<td>";
                                                        echo $report["title"];
                                                    echo "</td>";
                                                    echo "<td>";
														$purchase = $report["num_purchase"];
														if (strcasecmp($purchase,"")==0){
															$purchase = 0;
														}
                                                        echo $purchase;
                                                    echo "</td>";
                                                    echo "<td>";
														$wishlist = $report["num_wishlist"];
														if (strcasecmp($wishlist,"")==0){
															$wishlist = 0;
														}
                                                        echo $wishlist;
														//echo "10";
                                                    echo "</td>";
													echo "<td>";
														$browsed = $report["num_browsed"];
														if (strcasecmp($browsed,"")==0){
															$browsed = 0;
														}
                                                        echo $browsed;
														//echo "10";
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
                                         ?>
                                    </tbody>
                                </table>
                                <!--<a href="add_reports.php"><button class="btn btn-default" type="button">Add reports</button></a>-->
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
		var label = $(this).find('td:first').html();
		var purchase = $(this).find('td:first').next().html();
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

	var plotObj = $.plot($("#flot-pie-chart-purchase"), data, {
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

	var plotObj = $.plot($("#flot-pie-chart-wishlist"), data, {
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
		var purchase = $(this).find('td:first').next().next().next().html();
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

	var plotObj = $.plot($("#flot-pie-chart-browse"), data, {
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
