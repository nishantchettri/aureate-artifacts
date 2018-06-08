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
	
	include_once('../class/artifact.class.php');
	include_once('../class/artifactimagepath.class.php');
	include_once('../class/promotions.class.php');
	
?>


<!DOCTYPE HTML>
<html>
<head>
<title>On Sale</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php 
	include_once('../includes/js.php');
	include_once('../includes/css.php'); 
?>
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
		<!-- start gallery_sale  -->
			<div class="gallery1">
				<div class="container">
					<ul id="filters" class="clearfix">
						<li><span class="filter active" data-filter="all">All</span></li>
						<!--<li><span class="filter" data-filter="app card web">thangka</span></li>
						<li><span class="filter" data-filter="icon web card">khukuri</span></li>
						<li><span class="filter" data-filter="web app icon card">singing bowls</span></li>-->
						<li><span class="filter" data-filter="Thangka">thangka</span></li>
						<li><span class="filter" data-filter="Khukuri">khukuri</span></li>
						<li><span class="filter" data-filter="Singing Bowl">singing bowls</span></li>
					</ul>
					<div id="portfoliolist">
						<?php 
						$promotionDao = new promotions();
						$promoList = $promotionDao->getAllValidPromotions();
						
						foreach ($promoList as $promoItem){ 
							$artifact_id = $promoItem['artifact_id'];
							$discount = $promoItem['discount'];
							
							$artifactDao = new artifact();
							$artifactInfo = $artifactDao->getArtifactByID($artifact_id);
							$art = $artifactInfo->fetch();
							$artifact_title = $art['title'];	
							$artifact_type = $art['artifact_type'];
							
							$artifactImageDao = new artifactimagepath();
							$artifactImage = $artifactImageDao->getImageByID($artifact_id);
							$image = $artifactImage->fetch();
							$imageURL = $image['image_path'];
						?>
						<div class="portfolio <?php echo $artifact_type ?>" data-cat="<?php echo $artifact_type ?>">
							<div class="portfolio-wrapper">				
								<a  href=<?php echo "details.php?aid=" . $artifact_id ?>>
									<img src="<?php echo $dbRoot . $imageURL ?>"  alt="<?php echo $artifact_title ?>" />
								</a>
								<div class="label">
									<div class="label-text">
										<a class="text-title"><?php echo $artifact_title ?></a>
										<span class="text-category"><?php echo $artifact_type . ": " . $discount*100 . "% off" ?></span>
									</div>
									<div class="label-bg"></div>
								</div>
							</div>
						</div>	
						<?php } ?>
					</div>
				</div>
				<!-- container -->
				<script type="text/javascript" src="../js/fliplightbox.min.js"></script>
				<script type="text/javascript">$('body').flipLightBox()</script>
				<div class="clear"> </div>
			</div>
			<!---End-gallery----->
		</div>
	</div>
</div>		
<!-- start footer -->
<?php include_once('../includes/footer.php'); ?>
<script type="text/javascript">
	$(function () {
		var filterList = {
			init: function () {
			
				// MixItUp plugin
				// http://mixitup.io
				$('#portfoliolist').mixitup({
					targetSelector: '.portfolio',
					filterSelector: '.filter',
					effects: ['fade'],
					easing: 'snap',
					// call the hover effect
					onMixEnd: filterList.hoverEffect()
				});
			},
			
			hoverEffect: function () {
				// Simple parallax effect
				$('#portfoliolist .portfolio').hover(
					function () {
						$(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
						$(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');				
					},
					function () {
						$(this).find('.label').stop().animate({bottom: -40}, 200, 'easeInQuad');
						$(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');								
					});				
			}
		};
		
		// Run the show!
		filterList.init();
	});	
	</script>
<!-- start top_js_button -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
		});
	});
</script>
</body>
</html>