<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
	session_start();
	include_once('../class/customer.class.php');
	include_once('../class/address.class.php');
	include_once('validateUser.php');
	
	$customer = new customer();
	$address = new address();
	$email = $_SESSION['username'];
	
	// UPDATE PROFILE INFORMATION
	if(isset($_POST['save'])){
		$addr_id = $_POST['addr_id'];
		$contact = $_POST['phone'];
		$addr1 = $_POST['address1'];
		$addr2 = $_POST['address2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$postcode = $_POST['postcode'];
		
		// UPDATE CUSTOMER CONTACT
		$updateCustomer = $customer->updateCustomer($email, $contact);
		
		// UPDATE CUSTOMER ADDRESS
		$updateAddress = $address->updateAddress($addr_id, $addr1, $addr2, $city, $state, $country, $postcode);
	}
	
	// GET CUSTOMER INFORMATION
	if(isset($_SESSION['username'])){
		$getCustomer = $customer->getCustomerByEmail($email);
		$fname = "";
		$lname = "";
		foreach($getCustomer as $get){
			$fname = $get['fname'];
			$lname = $get['lname'];
			$contact = $get['contact'];
			$add_id = $get['addr_id'];
			$cust_addr1 = $get['addr_street1'];
			$cust_addr2 = $get['addr_street2'];
			$city = $get['addr_city'];
			$state = $get['addr_state'];
			$country = $get['addr_country'];
			$postcode = $get['addr_postcode'];
		}
	}

	// REDIRECT TO CHANGE PASSWORD PAGE
	if(isset($_POST['password'])){
		header('location:change_pass.php');
	} 
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Edit Profile</title>
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
			<div class="contact">
				<div class="contact-form">
					<h2>Edit Information</h2>
					<form method="post" action="edit_profile.php" id="edit_profile">
						<input name="addr_id" type="hidden" value="<?php echo $add_id ?>" />
						<div>
							<span><label>First Name</label></span>
							<span><input name="fname" type="text" class="textbox" autofocus readonly="true" value="<?php echo $fname; ?>"></span>
						</div>
						<div>
							<span><label>Last Name</label></span>
							<span><input name="lname" type="text" class="textbox" readonly="true" value="<?php echo $lname; ?>"></span>
						</div>
						<div>
							<span><label>E-mail</label></span>
							<span><input name="email" type="text" class="textbox" readonly="true" value="<?php echo $email; ?>"style="text-transform:lowercase"></span>
						</div>
						<div>
							<span><label>Mobile</label></span>
							<span><input name="phone" type="text" class="textbox" value="<?php echo $contact; ?>"></span>
						</div>
						<div>
							<span><label>address street 1</label></span>
							<span><input name="address1" type="text" class="textbox" value="<?php echo $cust_addr1; ?>"></span>
						</div>
						<div>
							<span><label>address street 2</label></span>
							<span><input name="address2" type="text" class="textbox" value="<?php echo $cust_addr2; ?>"></span>
						</div>
						<div>
							<span><label>city</label></span>
							<span><input name="city" type="text" class="textbox" value="<?php echo $city; ?>"></span>
						</div>
						<div>
							<span><label>state</label></span>
							<span><input name="state" type="text" class="textbox" value="<?php echo $state; ?>"></span>
						</div>
						<div>
							<span><label>country</label></span>
							<span><input name="country" type="text" class="textbox" value="<?php echo $country; ?>"></span>
						</div>
						<div>
							<span><label>postcode</label></span>
							<span><input name="postcode" type="text" class="textbox" value="<?php echo $postcode; ?>"></span>
						</div>
						<div>
							<span><input type="submit" class="" name="save" value="Save"></span>
							<span><input type="submit" class="" name="password" value="Change Password"></span>
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
</html>