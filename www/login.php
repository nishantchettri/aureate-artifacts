<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
	session_start();
	include_once('../class/customer.class.php');
	extract($_POST);
	extract($_GET);
	if(isset($_POST['login'])){
		$email = $_POST['username'];
		$password = $_POST['password'];
		$customer = new customer();
		$returnArray = $customer->validateUser($email, $password);
		$valid = $returnArray[0];
		$customer_id = $returnArray[1];
		if($valid > 0){
			$_SESSION['customer_id'] = $customer_id;
			$_SESSION['username'] = $email;
			header('location:dashboard.php');				
		} else {
			$error = 1;
		}
	} else if (isset($_POST['signup'])){
		header('location:sign_up.php');
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Sign In</title>
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
				<h2 style="text-align:center">Login</h2>
				<div class="contact-form">
					<?php if($error == 1){ ?>
					<div style="text-align:center; margin:20px; background-color:lightgray; padding:10px 0 10px 0; width:50%; margin-left:auto; margin-right:auto">
						<h3>Incorrect Username or password</h3>
					</div>
					<?php } ?>
					<form method="post" action="login.php" style="width:50%; margin-left:auto; margin-right:auto">
						<div>
							<span><label>Email Address</label></span>
							<span><input name="username" type="text" class="textbox" style="text-transform:none"></span>
						</div>
						<div>
							<span><label>Password</label></span>
							<span><input name="password" type="password" class="textbox password-textbox"></span>
						</div>
						<div>
							<span><input name="login" type="submit" class="" value="Login"></span>
							<span style="margin-left:10px"><input name="signup" type="submit" class="" value="Sign Up"></span>
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