<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
	session_start();
	extract($_GET);
	extract($_POST);
	include_once('../class/checkout.class.php');
	include_once("../class/promotions.class.php");
	include_once('validateUser.php');

	$customer_id = $_SESSION['customer_id'];
	
	if(isset($_GET['del'])){
		$artifact_id = $_GET['del'];
		$checkout = new checkout();
		$deleteCheck = $checkout->deleteCartItemByID($customer_id, $artifact_id);
		$res = $deleteCheck->rowCount();
		if($res == 1){
			echo "<script>alert('Deleted')</script>";
		} else {
			header('location:checkout.php');
			exit();
		}
	} 
	
	$checkout = new checkout();
	$checkoutList = $checkout->getCartByID($customer_id);
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Checkout List</title>
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
			<div class="panel-heading">Checkout List<h3 id="confirm" style="float:right;"><a href="payment.php">Confirm Purchase</a></h3></div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Artifact</th>
								<th>Quantity</th>
								<th>Unit Price</th>
								<th>Unit Total</th>
								<th>Request</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($checkoutList as $checkoutItem){
									$artifact_id = $checkoutItem['artifact_id'];
									$artifact = $checkoutItem['title'];
									$qty = $checkoutItem['quantity'];
									$price = $checkoutItem['retail_price'];
									$request = $checkoutItem['request'];
									
									$promotionDAO = new promotions();
									$promotionRow = $promotionDAO->hasPromotion($artifact_id);
									if($promotionRow->rowCount() > 0){
										$newPrice = $promotionRow->fetch();
										$price = $newPrice['new_price'];
									}
							?>		
							<tr class="odd gradeX" style="text-align:center">
								<td><?php echo $artifact ?></td>
								<td><?php echo $qty ?></td>
								<td><?php echo $price ?></td>
								<td class="total"><?php echo $price * $qty?></td>
								<td><?php echo $request ?></td>
								<td class="delete"><a href="checkout.php?del=<?php echo $artifact_id ?>">Remove Item</a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
		<div class="row" style="padding-bottom:20px">
			<h1 id="price" style="text-align:center; font-weight:bold; font-size:30px">Total Price: 0</h1>
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
			var price = $(this).find('.total').text();
			finalPrice = finalPrice + parseInt(price);
		});
		if(!isNaN(finalPrice)){
			$("#price").text("Total price: " + String(finalPrice));
		} else {
			$("#confirm").css("display","none");
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

