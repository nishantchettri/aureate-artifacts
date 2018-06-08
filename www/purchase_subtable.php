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
	include_once("../class/courier.class.php");
	include_once("../class/purchasecustomize.class.php");
	include_once('validateUser.php');
	
	$customer_id = $_SESSION['customer_id'];
	$invoice = new invoice();
	$invoice_no = 0;
	$fee_price = 0;
	if(isset($_GET['ino']) && !empty($_GET['ino'])){
		$invoice_no = $_GET['ino'];
		$getInvoiceList = $invoice->getInvoiceItemList($customer_id, $invoice_no);
		$getInvoice = $invoice->getCourierForInvoice($invoice_no);
		$couriername = $getInvoice->fetch();
		
		// Get courier service charge
		$courier = new courier();
		$getCharge = $courier->getCourierByName($couriername['courier_name']);
		$charge = $getCharge->fetch();
		$fee_price = $charge['fee'];
	} else {
		header('location:purchase_history.php');
		exit();
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
		#subtext{
			font-size:14px;
			color:gray;
		}
	
	</style>
</head>
<body>
<!-- start header -->
<?php 
	include_once('../includes/header.php');
	include_once('../includes/navbar.php');
 ?>
<!-- start main -->
<div class="main_bg">
	<div class="wrap">	
		<div class="main">
			<!--<h2 class="style top">Checkout</h2>-->	
		</div>
	</div>
</div>	

<div class="container-fluid">
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Details for invoice: #<?php echo $invoice_no ?><h3 style="float:right;"><a href="purchase_history.php">Go Back</a></h3></div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Artifact Title</th>
								<th>Quantity</th>
								<th>Unit Price</th>
								<th>Request</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($getInvoiceList as $invoiceItem){
									$artifact_id = $invoiceItem['artifact_id'];;
									$title = $invoiceItem['title'];
									$qty = $invoiceItem['quantity'];
									$price = $invoiceItem['unit_price'];
									
									// Get Request									
									$invoiceRequest = new invoice();
									$request = $invoiceRequest->getInvoiceRequest($invoice_no, $artifact_id)->fetch();
							?>		
							<tr class="odd gradeX" style="text-align:center">
								<td class=""><?php echo $title ?></td>
								<td class=""><?php echo $qty ?></td>
								<td class="artifact_price"><?php echo $price ?></td>
								<td class=""><?php echo $request['request'] ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
		<div class="row" style="padding-bottom:20px;text-align:center;">
			<span id="price" style=" font-weight:bold; font-size:30px">Total Price: 0</span><span id="subtext"> (plus service charge: <?php echo $fee_price; ?>)</span>
		</div>
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
		calculatePrice();
    });
	
	function calculatePrice(){
		var finalPrice = 0;
		$('.table').find('tbody tr').each(function(){
			var price = $(this).find('.artifact_price').text();
			finalPrice = finalPrice + parseInt(price);
		});
		if(!isNaN(finalPrice)){
			$("#price").text("Total price: " + String(finalPrice));
		}
	}
    </script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});
	</script>
</body>
</html>

