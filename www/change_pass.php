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
	include_once('../class/customer.class.php');
	include_once('validateUser.php');
	
	$customer = new customer();
	
	if(isset($_POST['edit'])){
		header('location:edit_profile.php');
	}
	
	if(isset($_POST['change'])){
		$currpass = $_POST['cpass'];
		$newpass1 = $_POST['newpass1'];
		$newpass2 = $_POST['newpass2'];
		
		if(!empty($currpass) && !empty($newpass1) && !empty($newpass2)){
			$email = $_SESSION['username'];
			$customer_id = $_SESSION['customer_id'];
			$customer = new customer();
			$returnArray = $customer->validateUser($email, $currpass);
			$match = $returnArray[0];
			if($match > 0){
				if(strcmp($newpass1, $newpass2)==0){
					$salt = hash("sha256", strval(rand()));
					$saltedPassword = $newpass1 . $salt;
					$hashedSaltedPassword = hash("sha256", $saltedPassword);
					$customer = new customer();
					$changePass = $customer->changePassword($customer_id, $hashedSaltedPassword, $salt);
					if($changePass == 1){
						echo "<script>alert('Password Successfully Changed');</script>";
						//header('location:dashboard.php');
					}
				} else {
					echo "<script>alert('Passwords do not match');</script>";
				}
			}
		}else{
			echo "<script>alert('Please enter value for all fields');</script>";			
		}
	}

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Change Password</title>
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
	<style>
		#change_pass{
			text-transform:none;
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
		<div class="main" style="width:50%; margin-left:auto; margin-right:auto">
			<div class="contact">
				<div class="contact-form">
					<h2>Change Password</h2>
					<form method="post" action="change_pass.php" id="change_pass" autocomplete="off">
						<div>
							<span><label>Current Password</label></span>
							<span><input name="cpass" type="password" style="display:none" class="textbox password-textbox"></span>
							<span><input name="cpass" type="password" class="textbox password-textbox"></span>
						</div>
						<div>
							<span><label>New Password</label></span>
							<span><input name="newpass1" style="display:none" type="password" class="textbox password-textbox"></span>
							<span><input name="newpass1" type="password" class="textbox password-textbox"></span>
						</div>
						<div>
							<span><label>Re-confirm New Password</label></span>
							<span><input name="newpass2" style="display:none" type="password" class="textbox password-textbox"></span>
							<span><input name="newpass2" type="password" class="textbox password-textbox"></span>
						</div>
						<div>
							<span><input type="submit" class="" name="change" value="save"></span>
							<span><input type="submit" class="" name="edit" value="go back"></span>
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