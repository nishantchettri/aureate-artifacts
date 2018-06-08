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
	include_once("../class/artifact.class.php");
	include_once("../class/artifactreview.class.php");
	include_once("../class/artifactimagepath.class.php");
	include_once("../class/browsehistory.class.php");
	include_once("../class/checkout.class.php");
	include_once("../class/wishlist.class.php");
	include_once("../class/promotions.class.php");	
	
	if(isset($_POST['review'])){
		$artifact_id = $_POST['artifact_id'];
		$customer_id = $_SESSION['customer_id'];
		$review = $_POST['review_message'];
		echo $review;
		$reviewDao = new artifactReview();
		$addReview = $reviewDao->insertArtifactReview($artifact_id, $customer_id, $review);
		if($addReview->rowCount() > 0){
			echo "<script>alert('Review Posted')</script>";
		}
		header('location:details.php?aid='.$artifact_id);
	}
	
	// WHEN ADD TO CART BUTTON OR WISHLIST BUTTON IS PRESSED
	if(isset($_POST['cart']) && isset($_POST['artifact_id'])){
		$checkoutDao = new checkout();
		$customer_id = $_SESSION['customer_id'];
		$artifact_id = $_POST['artifact_id'];
		$request = $_POST['request'];
		$qty = $_POST['quantity'];
		$addToCart = $checkoutDao->insertCartItem($customer_id, $artifact_id, $qty, $request);
		if ($addToCart->rowCount() == 0){
			echo "<script>alert('Item may be already in cart!');</script>";
			header('location:details.php?aid='.$artifact_id);
			exit();
		} else {
			echo "<script>alert('Item added to cart!');</script>";
			header('location:checkout.php');
			exit();
		}
	} else if (isset($_POST['wishlist']) && isset($_POST['artifact_id'])){
		$customer_id = $_SESSION['customer_id'];
		$artifact_id = $_POST['artifact_id'];
		$wishlistDao = new wishlist();
		$insertItem = $wishlistDao->insertIntoWishlist($customer_id, $artifact_id);
		if($insertItem->rowCount() > 0){
			echo "<script>alert('Added to your wishlist');</script>";
			header('location:wishlist.php');
			exit();
		} else {
			header('location:wishlist.php');
			exit();
		}
	}
	
	// VALIDATE PAGE EXISTS AND ADD TO BROWSEHISTORY
	if(isset($_GET['aid']) && !empty($_GET['aid'])){
		$artifact_id= $_GET['aid'];
		$getArtifact = new artifact();
		$thisArtifact = $getArtifact->getArtifactByID($artifact_id);
		// DONT ADD TO BROWSEHISTORY IF WISHLIST OR CART BUTTON IS PRESSED
		if(isset($_SESSION['customer_id']) && (!isset($_POST['cart']) || !isset($_POST['wishlist']))){
			$customer_id = $_SESSION['customer_id'];
			$browsehistoryDao = new browsehistory();
			$insertHistory = $browsehistoryDao->addHistory($customer_id, $artifact_id);
		}
		$getArtifactReview = new artifactReview();
		$reviewList = $getArtifactReview->getArtifactReviewByID($artifact_id);
	} else {
		// Check if artifact id is coming from a submit button
		if(!isset($_POST['artifact_id'])){
			header('location:index.php');
			exit();
		}
	}
	
	$login = 0;
	if(isset($_SESSION['customer_id'])){
		$login = 1;
	}
	
	$promo = 0;
	$promotionDAO = new promotions();
	$promotionValue = $promotionDAO->hasPromotion($_GET['aid']);
	$promotionalPrice = 0;
	if($promotionValue->rowCount() == 1){
		$promotionRow = $promotionValue->fetch();
		$promotionalPrice = $promotionRow['new_price'];
		$promo = 1;
	}
	
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Details</title>
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
	hr{
		border:1px solid lightgray;
	}
	.available{
		font-family: 'Source Sans Pro', sans-serif;
	}
	.review_header{
		font-size:25px;
		margin-top:20px;
	}	
	.review_row{
		font-family: 'Source Sans Pro', sans-serif;
	}
	.review_row p{
		font-size:14px;
		text-transform:capitalize;
		margin-top:5px;
	}
	.input_counter{
		width:100px; 
		line-height:2; 
		border:1px solid lightgray; 
		padding-left:10px;
		font-size:18px;
	}
	.frame{
		display:inline !important; 
		width:24% !important; 
		margin-left:15px !important; 
		border:1px solid lightgray !important;
		font-size:18px;
		color:black !important;
	}
	.label{
		color:gray;
		margin-right:10px;
	}
	.request{
		margin-top:10px;
	}
	.strikethrough{
		text-decoration:line-through;
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
		<!-- start span1_of_1 -->
			<div class="left_content" style="width:auto">
				<div class="span1_of_1">
					<!-- start product_slider -->
					<div class="product-view">
						<div class="product-essential">
							<div class="product-img-box">
								<div class="product-image" style="margin-left:auto; margin-right:auto; width:auto">
									<?php 
										$artifactImageDao = new artifactimagepath();
										$artifactImage = $artifactImageDao->getImageByID($_GET['aid']);
										$imageURL = $artifactImage->fetch();
									?>
									<img src="<?php echo $dbRoot.$imageURL['image_path'] ?>" alt="" />
								</div>
							</div>
						</div>
					</div>
					<!-- end product_slider -->
				</div>
				<!-- start span1_of_1 -->
				<div class="span1_of_1_des">
					<div class="desc1" style="float:none">
						<?php
						$art=$thisArtifact->fetch();
						$id=$art['artifact_id'];
						$title=$art['title'];
						$price=$art['retail_price'];
						$detail=$art['description'];
						$type = "bowl";
						
						if ($promo == 1){
							$price = "NRs. <span class='strikethrough'>".$price."</span> ".$promotionalPrice;
						} else {
							$price = "NRs. ".$price;
						}
						
						?>
						<h3><?php echo $title?></h3>
						<p style="font-size:16px"><?php echo $detail?></p>
						<h5 align="center" style="margin-bottom:20px"><?php echo $price ?></h5>
						
						<div class="contact">
							<div class="contact-form">	
								<form action="details.php" method="post">
									<!-- QUANTITY FOR ALL-->
									<div class="input_number">
										<label class="label" for="qty">Quantity</label>
										<input name="quantity" type="number" min="1" value="1" class="input_counter" />
									</div>
									
									<!-- FRAME FOR THANGKA 
									<?php if(strcasecmp($type,"thangka")==0){ ?>
										<div>
											<label class="label" for="frame">Frame</label>
											<select name="frame" class="textbox frame" >
												<option>Yes</option>
												<option>No</option>
											</select>
										</div>
									<?php } ?>-->
									
									<!-- COLOR FOR SINGING BOWL 
									<?php if(strcasecmp($type,"bowl")==0){ ?>
										<div>
											<label class="label" for="color">Color</label>
											<select name="color" class="textbox frame" style="margin-left:21px !important" >
												<option>Red</option>
												<option>Pink</option>
												<option>Blue</option>
												<option>Green</option>
												<option>Brown</option>
												<option>Lavender</option>
												<option>Purple</option>
												<option>Black</option>
											</select>
										</div>
									<?php } ?>-->
									
									<!-- ENGRAVING FOR SINGING BOWL / KHUKURI -->
									<?php //if(strcasecmp($type,"bowl")==0 || strcasecmp($type,"khukuri")==0){ ?>
										<div>
											<label class="label" for="request">Special Request</label>
											<textarea name="request" class="textbox request" ></textarea>
										</div>
									<?php //} ?>
									
									<!-- CHECK IF USER HAS LOGGED IN OR NOT -->
									<?php if($login == 0){ ?>
										<div class="available" style="padding:10px;">
											<span class="" style="font-size:20px; text-align:center;">
												<a href="login.php" style="padding:0">login to buy or add to wishlist</a></span>
											<div class="clear"></div>
										</div>
										<?php } else { ?>
										<div class="available">
											<div class="btn_form" style="margin-top:0; align:center">
												<input type="hidden" name="artifact_id" value="<?php echo $_GET['aid']; ?>" />
												<input type="submit" name="cart" value="add to cart" title="" />
												<input type="submit" name="wishlist" value="add to wishlist" title="" />
											</div>
											<div class="clear"></div>
										</div>
										<?php } ?>
									</div>
								</form>
							</div>
						</div>
					<div class="clear"></div>
				</div>					
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class ="review">
				<h1 class="review_header"> CUSTOMER REVIEWS </h1>
				<hr>
					<div class="contact">
						<div class="contact-form">
							<?php if($login == 1){ ?>
							<form method="POST" action="details.php">
								<input type="hidden" value="<?php echo $_GET['aid']; ?>" name="artifact_id"/>
								<textarea name="review_message" class="textbox" placeholder="enter a comment (only one comment per user)" rows="3" style="width:98%; padding:10px; border:1px solid lightgray"></textarea>
								<input class="" type="submit" name="review" value="post comment" />
							</form>
							<?php }else{ ?>
								<div class="available" style="padding:10px;">
									<span style="font-size:20px; text-align:center;">
										<a href="login.php" style="padding:0">login to add comment</a>
									</span>
									<div class="clear"></div>
								</div>
							<?php } ?>
						</div>
					</div>
					<?php foreach($reviewList as $review){
					$fname = $review['fname'];
					$lname = $review['lname'];
					$time = $review['review_time'];
					$rev = $review['review']; 
					?>
					<div class="row review_row">
						<h3 style="font-weight:bold; text-transform:capitalize""><?php echo $fname. " ".$lname." (posted on: ".$time.")" ?></h3>
						<p><?php echo $rev ?></p>
					</div>
					<hr>
				<?php } ?>
				
				</div>
			</div>
		</div>	
		<!-- end content -->
	</div>
</div>
<!-- start footer -->
<?php include_once('../includes/footer.php'); ?>
</body>
</html>