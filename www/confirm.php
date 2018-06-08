<?php
	session_start();
	extract($_POST);
	extract($_GET);
	include_once('validateUser.php');
	
	$customer_id = $_SESSION['customer_id'];
	
	// Incoming values from payment.php
	if(isset($_POST['confirm'])){
		$purchase_type = $_POST['purchase_type'];
		$payment_type = $_POST['payment_type'];
		$card_number = $_POST['card_number'];
		$courier = $_POST['courier_service'];
		
		if (strcasecmp($payment_type,"0")==0 || strcasecmp($courier,"0")==0 || strcasecmp(trim($card_number),"")==0){
			header('location:payment.php?err=inc');
		}
	} else {
		header('location:checkout.php');
	}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Confirm</title>
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
<div class="row" style="text-align:center">
	<div class="col-md-12" >
		<div class="panel panel-default">
			<div class="panel-heading">Are you sure?</div>
			<!-- /.panel-heading -->
			<div class="panel-body contact-form" style="text-align:center">
			<form method="post" action="save_invoice.php">
				<input type="hidden" name="purchase_type" value="<?php echo $purchase_type ;?>" />
				<input type="hidden" name="payment_type" value="<?php echo $payment_type ;?>" />
				<input type="hidden" name="payment_number" value="<?php echo $card_number ;?>" />
				<input type="hidden" name="courier" value="<?php echo $courier ;?>" />
				
				<input type="submit" name="yes" class="" value="yes" />
				<input type="submit" name="no" class="" value="no" />
			</form>
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

