<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
	include_once('validateUser.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>My Account</title>
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
		<!-- start grids_of_3 -->
		<div class="grids_of_3">
			<div class="grid1_of_3">
				<a href="purchase_history.php">
					<img src="../images/purchase_history.png" alt="" height="150px" width="auto"/>
					<h3>purchase history</h3>
					<span class="b_btm"></span>
				</a>
			</div>
			<div class="grid1_of_3">
				<a href="checkout.php">
					<img src="../images/cart_large.png" alt="" height="150px" width="auto"/>
					<h3>checkout list</h3>
					<span class="b_btm"></span>
				</a>
			</div>
			<div class="grid1_of_3">
				<a href="edit_profile.php">
					<img src="../images/profile.png" alt="" height="150px" width="auto"/>
					<h3>edit profile</h3>
					<span class="b_btm"></span>
				</a>
			</div>
			<div class="clear"></div>
		</div>
		<div class="grids_of_3">
			<div class="grid1_of_3">
				<a href="wishlist.php">
					<img src="../images/wishlist.png" alt="" height="150px" width="auto"/>
					<h3>wishlist</h3>
					<span class="b_btm"></span>
				</a>
			</div>
			<div class="clear"></div>
		</div>
		<!-- end grids_of_3 -->
	</div>
</div>
</div>		
<!-- start footer -->
<?php include_once('../includes/footer.php'); ?>
</body>
</html>