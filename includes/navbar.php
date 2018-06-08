<?php
	include_once("../class/connect.class.php");
	include_once("../class/customer.class.php");
	
	error_reporting(0);
	session_start();
	extract($_POST);
	extract($_GET);	
	$login = 0;
	$customer = new customer();
	if(isset($_SESSION['username'])){
		$login = 1;
	}
?>
<!-- start navbar -->
<div class="header_btm">
<div class="wrap">
	<div class="header_sub">
		<div class="h_menu">
			<ul>
				<li><a href="index.php">Home</a></li> |
				<li><a href="thangka.php">Thangkas</a></li> |
				<li><a href="khukuri.php">Khukuris</a></li> |
				<li><a href="singing_bowl.php">Singing Bowls</a></li> |
				<li><a href="sale.php">On Sale</a></li> |
				<li><a href="contact.php">Contact us</a></li> |
				<?php
					if($login == 0){ ?>
				<li><a href="login.php">My Account</a></li>
					<?php } else { ?>
				<li class="dropdown"><a href="dashboard.php">Dashboard</a>
					<div class="dropdown-content">
						<!--<a href="login.php">Sign In</a>
						<a href="dashboard.php">Dashboard</a>-->
						<a href="checkout.php">Checkout</a>
						<a href="purchase_history.php">Purchase History</a>
						<a href="wishlist.php">Wishlist</a>
						<a href="edit_profile.php">Edit Profile</a>
						<a href="logout.php">Sign Out</a>
					</div>				
				</li>
					<?php } ?>
			</ul>
		</div>
		<div class="top-nav">
		  <nav class="nav">	        	
			<a href="#" id="w3-menu-trigger"> </a>
				<ul class="nav-list" style="">
					<li class="nav-item"><a href="index.php">Home</a></li>
					<li class="nav-item"><a href="thangka.php">Thangkas</a></li>
					<li class="nav-item"><a href="khukuri.php">Khukuris </a></li>
					<li class="nav-item"><a href="singing_bowl.php">Singing Bowls</a></li>
					<li class="nav-item"><a href="sale.php">On Sale</a></li>
					<li class="nav-item"><a href="contact.php">Contact</a></li>
					<?php
					if($login == 0){ ?>
					<li class="nav-item"><a href="login.php">My Account</a></li>
					<?php } else { ?>
					<li class="nav-item"><a href="checkout.php">Checkout</a></li>
					<li class="nav-item"><a href="purchase_history.php">Purchase History</a></li>
					<li class="nav-item"><a href="wishlist.php">Wishlist</a></li>
					<li class="nav-item"><a href="edit_profile.php">Edit Profile</a></li>
					<li class="nav-item"><a href="logout.php">Sign Out</a></li>
					<?php } ?>
				</ul>
		   </nav>
			 <div class="search_box">
			<form>
			   <input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
			</form>
		</div>
		  <div class="clear"> </div>
		  <script src="../js/responsive.menu.js"></script>
	 </div>		  
	<div class="clear"></div>
</div>
</div>
</div>