<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
	session_start();
	extract($_POST);
	extract($_GET);
	include_once("../class/invoice.class.php");
	include_once('validateUser.php');
	
	$customer_id = $_SESSION['customer_id'];
	$invoice = new invoice();
	$getInvoiceList = $invoice->getInvoiceList($customer_id);
	
	if(isset($_POST['search'])){
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		if(!empty($start_date) && !empty($end_date)){
			$getInvoiceList = $invoice->getInvoiceListByDate($customer_id, $start_date, $end_date);
		} else {
			//return false;
		}
	}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Purchase History</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="../css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS 
    <link href="../css/dataTables.responsive.css" rel="stylesheet">-->  
    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
<?php 
	include_once('../includes/css.php'); 	
?>

	<style>
		a:hover{
			text-decoration:none;
		}
	
	</style>
</head>
<body>
<!-- start header -->
<?php 
	include_once('../includes/header.php');
	include_once('../includes/navbar.php');
 ?>
<!-- start main 
<div class="main_bg">
	<div class="wrap">	
		<div class="main">
			<h2 class="style top">Purchase History</h2>
		</div>
	</div>
</div>	-->
<form method="post" action="purchase_history.php">
	<div class="col-md-4">
		<div class="contact">
			<div class="contact-form">
				<div>
					<span><label>Start Date</label></span>
					<span><input name="start_date" type="text" placeholder="YYYY-MM-DD" class="textbox" autofocus /></span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="contact">
			<div class="contact-form">
				<div>
					<span><label>End Date</label></span>
					<span><input name="end_date" type="text" placeholder="YYYY-MM-DD" class="textbox" autofocus /></span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="contact">
			<div class="contact-form">
				<div>
					<span><input name="search" type="submit" class="textbox" style="margin-top:20px" autofocus value="search by date" /></span>
				</div>
			</div>
		</div>
	</div>
</form>

<div class="container-fluid">
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Purchase History</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Invoice Number</th>
								<th>Purchase Date</th>
								<th>Courier Name</th>
								<th>Payment</th>
								<th>Purchase Type</th>
								<th>View Details</th>
							</tr>
						</thead>
						<tbody style="text-align:center">
							<?php
								foreach($getInvoiceList as $invoiceItem){
									$invoice = $invoiceItem['invoice_no'];
									$courier = $invoiceItem['courier_name'];
									$datetime = $invoiceItem['purchase_time'];
									$payment = $invoiceItem['payment'];
									$purchase_type = $invoiceItem['purchase_type'];
							?>		
							<tr class="odd gradeX" style="text-align:center">
								<td><?php echo $invoice ?></td>
								<td><?php echo $datetime ?></td>
								<td><?php echo $courier ?></td>
								<td><?php echo $payment ?></td>
								<td><?php echo $purchase_type ?></td>
								<td><a href="purchase_subtable.php?ino=<?php echo $invoice ?>">Click Here</a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
</div>
<!-- start footer -->
<?php
include_once('../includes/js.php');
include_once('../includes/footer.php');
?>		

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	<script src="../js/metisMenu.min.js"></script>
	<script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap.min.js"></script>
	<script src="../js/easing.js"></script>
	<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
   
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
		});
	});	
	</script>
</body>
</html>