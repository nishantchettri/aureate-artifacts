<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
	session_start();
	include_once('../class/courier.class.php');
	include_once('../class/checkout.class.php');
	include_once('validateUser.php');
	
	$err = "";
	if(isset($_GET['err'])){
		$err = $_GET['err'];
	}
	
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Payment</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php 
	include_once('../includes/css.php');
	include_once('../includes/js.php');
?>
   <script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});
	</script>
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
			<?php if(strcasecmp($err,"inc")==0){ ?>
			<div class="error">Incorrect / Incomplete Information</div>
			<?php } ?>
			<div class="contact">
				<div class="contact-form">
					<h2>Payment Information</h2>
					<form method="post" action="confirm.php" id="payment">
						<input name="purchase_type" type="hidden" value="Online" />
						<div>
							<span><label>Payment Method</label></span>
							<span>
								<select name="payment_type" class="textbox" style="width:98%">
									<option value="0">-------Select Payment Type-------</option>
									<option value="Debit">Debit Card</option>
									<option value="Credit">Credit Card</option>
								</select>
							</span>
						</div>
						<div>
							<span><label>Card Number</label></span>
							<span>
									<input name="card_number" placeholder="your debit or credit card number" type="text" class="textbox" id="card_number" />							
							</span>
						</div>
						<div class="clear"></div>
						<div class="clear"></div>
						<h2>Item Delivery Information</h2>
						<div>
							<span><label>Courier Service</label></span>
							<span>
							<select name="courier_service" class="courier" style="width:98%">
								<option value="0" fee_price="0.00 (will change when courier is selected)">-------Select Courier Service-------</option>
								<?php 
								$courier = new courier();
								$allCouriers = $courier->getAllCouriers();
								foreach($allCouriers as $courService){
								?>
									<option value="<?php echo $courService['courier_name'] ?>" id="<?php echo $courService['courier_name'] ?>" fee_price="<?php echo $courService['fee'] ?>"><?php echo $courService['courier_name'] ?></option>
								<?php } ?>
							</select></span>
						</div>
						<div>
							<span><label>Service Charge</label></span>
							<span><input name="charge" placeholder="0.00 (will change when courier is selected)" type="text" class="textbox" readonly="true" id="fee-charge"></span>
						</div>
						<div>
							<span><input type="submit" class="" name="confirm" value="confirm"></span>
							<span><input type="submit" class="" name="cancel" value="cancel"></span>
						</div>
					</form>
				</div>
				<div class="clear"></div>		
			</div>
		</div>
	</div>
</div>		
<!-- start footer -->
<?php include_once('../includes/footer.php'); ?>
</body>
<script>
	$('.courier').on('change',function(){
		var fee_price = $(this).find('option:selected').attr('fee_price');
		$("#fee-charge").val(fee_price);
	});

</script>

</html>