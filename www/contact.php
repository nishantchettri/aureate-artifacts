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
	
	if(isset($_POST['mail'])){
		$to = "nishant_chhettri@hotmail.com";
		$subject = "Message from Contact Us Form";
		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$message = $_POST['message'];
		
		$headers="From:".$email."\r\n";
		$headers.="MIME-version:1.0\r\n";
		$headers.="content-type: text/html; charset=iso-8859-1\r\n";
		//echo $headers;
		//$res = mail("nishant_chhettri@hotmail.com", $subject, $message, $headers);
		if(mail($to, $subject, $message, $headers))
		{
			//echo "<script> window.alert('Your message has been sent!')</script>";
		}
		else
		{
			//echo "<script> window.alert('ERROR! Your message has not been sent! Please enter a valid email address')</script>";
		}
	}

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Contact Us</title>
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
					<div class="contact_info">
						<h2>get in touch</h2>
			    	 		<div class="map">
								<!--<div class="overlay" onClick="style.pointerEvents='none'"></div>-->
					   			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7064.146916369476!2d85.30789372200992!3d27.71501812911812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb18fcb77fd4bd%3A0x58099b1deffed8d4!2sThamel%2C+Kathmandu+44600%2C+Nepal!5e0!3m2!1sen!2sus!4v1461341358754" width="600" frameborder="0" style="border:0; width:100%; height:350px" allowfullscreen></iframe>
								<br><small><a target="_blank" href="https://www.google.com/maps/place/Thamel,+Kathmandu+44600,+Nepal/@27.7150181,85.3078937,16z/data=!3m1!4b1!4m2!3m1!1s0x39eb18fcb77fd4bd:0x58099b1deffed8d4" style="color:#777777;text-align:left;font-size:13px;font-family: 'Source Sans Pro', sans-serif;">View Larger Map</a></small>
					   		</div>
      				</div>
					<div class="contact-form">
			 	  	 	<h2>Contact Us</h2>
			 	 	    <form method="post" action="contact.php">
					    	<div>
						    	<span><label>Name</label></span>
						    	<span><input name="name" type="text" class="textbox"></span>
						    </div>
						    <div>
						    	<span><label>E-mail</label></span>
						    	<span><input name="email" style="text-transform:none" type="text" class="textbox"></span>
						    </div>
						    <div>
						     	<span><label>Mobile</label></span>
						    	<span><input name="phone" type="text" class="textbox"></span>
						    </div>
						    <div>
						    	<span><label>Details</label></span>
						    	<span><textarea name="message"></textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" class="" name="mail" value="Submit"></span>
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