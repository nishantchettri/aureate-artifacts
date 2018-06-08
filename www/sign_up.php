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
	$customer = new customer();
	$address = new address();
	
	// INSERT PROFILE INFORMATION
	if(isset($_POST['save'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$contact = $_POST['phone'];
		$addr_street1 = $_POST['address1'];
		$addr_street2 = $_POST['address2'];
		$addr_city = $_POST['city'];
		$addr_state = $_POST['state'];
		$addr_country = $_POST['country'];
		$addr_postcode = $_POST['postcode'];
		$pass1 = $_POST['password'];
		$pass2 = $_POST['conf_password'];
		
		// Validate passwords
		if(!empty($pass1) && !empty($pass2) && strcasecmp($pass1,$pass2)==0){
			// INSERT ADDRESS BEFORE CUSTOMER
			$addressDao = new address();
			$insertAddress = $addressDao->insertAdddress($addr_street1, $addr_street2, $addr_city, $addr_state, $addr_country, $addr_postcode);
			$res = $insertAddress[0];
			$lastInsertId = $insertAddress[1];
			// INSERT CUSTOMER
			if($res->rowCount() > 0){
				$salt = hash("sha256", strval(rand()));
				$saltedPassword = $pass1 . $salt;
				$hashedSaltedPassword = hash("sha256", $saltedPassword);
				$customerDao = new customer();
				$insertCustomer = $customerDao->insertCustomer($fname, $lname, $lastInsertId, $contact, $email, $hashedSaltedPassword, $salt);				
				if ($insertCustomer->rowCount() > 0){
					//echo "<script>alert('Account created')</script>"; 
					header('location:login.php');
				}
			}
		} else {
			echo "<script>alert('Confirm your passwords match and are valid')</script>";
		}
	}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Sign Up</title>
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
					<h2>Profile Information</h2>
					<form method="post" action="sign_up.php" id="sign_up">
						<div>
							<span><label>First Name</label></span>
							<span><input name="fname" type="text" class="textbox" autofocus value=""></span>
						</div>
						<div>
							<span><label>Last Name</label></span>
							<span><input name="lname" type="text" class="textbox" value=""></span>
						</div>
						<div>
							<span><label>E-mail (will be used as username)</label></span>
							<span><input name="email" type="text" class="textbox" value="" style="text-transform:none"></span>
						</div>
						<div>
							<span><label>Mobile</label></span>
							<span><input name="phone" type="text" class="textbox" value=""></span>
						</div>
						<div>
							<span><label>address street 1</label></span>
							<span><input name="address1" type="text" class="textbox" value=""></span>
						</div>
						<div>
							<span><label>address street 2</label></span>
							<span><input name="address2" type="text" class="textbox" value=""></span>
						</div>
						<div>
							<span><label>city</label></span>
							<span><input name="city" type="text" class="textbox" value=""></span>
						</div>
						<div>
							<span><label>state</label></span>
							<span><input name="state" type="text" class="textbox" value=""></span>
						</div>
						<div>
							<span><label>country</label></span>
							<span><input name="country" type="text" class="textbox" value=""></span>
						</div>
						<div>
							<span><label>postcode</label></span>
							<span><input name="postcode" type="text" class="textbox" value=""></span>
						</div>
						<div>
							<span><label>password</label></span>
							<span><input name="password" type="password" style="display:none" class="textbox password-textbox" value=""></span>
							<span><input name="password" type="password" class="textbox password-textbox" value=""></span>
						</div>
						<div>
							<span><label>confirm password</label></span>
							<span><input name="conf_password" type="password" style="display:none" class="textbox password-textbox" value=""></span>
							<span><input name="conf_password" type="password" class="textbox password-textbox" value=""></span>
						</div>
						
						<div>
							<span><input type="submit" class="" name="save" value="Save"></span>
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