<?php
	error_reporting(0);
	session_start();
	extract($_POST);
	extract($_GET);
	include_once('../class/connect.class.php');
	include_once('../class/checkout.class.php');
	include_once("../class/promotions.class.php");
	
	$customer_id = $_SESSION['customer_id'];
	
	$checkout = new checkout();
	$checkoutTotal = $checkout->getCartByID($customer_id);
	$totalBought=0;
	if($checkoutTotal->rowCount()>0){
		foreach($checkoutTotal as $cartTotal){
			$artifact_id = $cartTotal['artifact_id'];
			$price = $cartTotal['retail_price'];
			$qty = $cartTotal['quantity'];
			$promotionDAO = new promotions();
			$promotionRow = $promotionDAO->hasPromotion($artifact_id);
			if($promotionRow->rowCount() > 0){
				$newPrice = $promotionRow->fetch();
				$price = $newPrice['new_price'];
			}
			$total = $price * $qty;
			$totalBought = $totalBought + $total;
		}
	}
?>

<div class="header_bg">
	<div class="wrap">
		<div class="header">
			<div class="logo"><a href="index.php"><img src="../logo.png" alt="" height="75px"/></a></div>
			<div class="h_icon" style="margin-top:10px;">
			<ul class="icon1 sub-icon1">
				<li><a class="active-icon c1" href="checkout.php"><i><?php echo $totalBought ?></i></a></li>
			</ul>
			</div>
			<div class="h_search" style="margin-top:20px; height:35px">
				<form>
					<input type="text" value="" />
					<input type="submit" value="" />
				</form>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>