<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php 
	session_start();
	extract($_POST);
	extract($_GET);
	include_once('../class/artifact.class.php');
	include_once('../class/artifactimagepath.class.php');
	include_once('../class/promotions.class.php');
	
	$getArtifact = new artifact();
	$artifactList = $getArtifact->getAllArtifacts();
	
	$getPromotions = new promotions();
	$promotionList = $getPromotions->getAllPromotions();
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Aureate Artifacts</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php
		include_once('../includes/css.php'); 
		include_once('../includes/js.php');
	?>
	<script type="text/javascript">
	$(function() {
		$('#da-slider').cslider();
	});
	</script>
	<!-- Owl Carousel Assets -->
	<!-- Prettify -->		    
	<script>
	$(document).ready(function() {
	  $("#owl-demo").owlCarousel({
		items : 4,
		lazyLoad : true,
		autoPlay : true,
		navigation : true,
		navigationText : ["",""],
		rewindNav : false,
		scrollPerPage : false,
		pagination : false,
		paginationNumbers: false,
	  });
	});
	</script>
	<!-- //Owl Carousel Assets -->
	<!-- start top_js_button -->
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
</head>
<body>
	<!-- start header and navbar -->
	<?php 
		include_once('../includes/header.php'); 
		include_once('../includes/navbar.php');
	?>


	<!-- start slider -->
	<div id="da-slider" class="da-slider">
		<?php 
			$count=0;
			foreach($artifactList as $artifact){ ?>
			<div class="da-slide">
				<h2><?php echo $artifact['title']; ?></h2>
				<p><?php echo $artifact['description'] ?></p>
				<a href="details.php?aid=<?php echo $artifact['artifact_id']?>" class="da-link">shop now</a>
				<?php 
					$artifactImageDao = new artifactimagepath();
					$artifactImage = $artifactImageDao->getImageByID($artifact['artifact_id']);
					$imageURL = $artifactImage->fetch();
				?>
				<div class="da-img"><img src="<?php echo $dbRoot.$imageURL['image_path'] ?>" alt="" /></div>
			</div>
		<?php 
			$count++;
			if($count==3){
				break;
			}
		} ?>
		<nav class="da-arrows">
			<span class="da-arrows-prev"></span>
			<span class="da-arrows-next"></span>
		</nav>
	</div>

	<!----start-carousel---->
	<div class="wrap">
	<!----start-promotions-carousel---->
		<div id="owl-demo" class="owl-carousel">
			<?php foreach($promotionList as $promotion){ ?>
					<div class="item" onclick="location.href='sale.php';">
						<div class="cau_left" style="font-size:20px;text-align:center"><span class="middle"><?php echo $promotion['title']; ?></span></div>
						<div class="cau_left">
							<h6 align="center" style="font-size:20px"><a href="#"><?php echo $promotion['discount']*100 . "% off"; ?></a></h6>
							<a href="sale.php" class="btn">view</a>
						</div>
					</div>	
			<?php } ?>
		</div>
		<!----//End-img-carousel---->
	</div>
	
	<!-- start main1 -->
	<div class="main_bg1">
		<div class="wrap">	
			<div class="main1">
				<h2>featured artifacts</h2>
			</div>
		</div>
	</div>

	<!-- start main -->
	<div class="main_bg">
		<div class="wrap">	
			<div class="main">
				<!-- start grids_of_3 -->
				<?php
				$count=0;
				$numRows = $artifactList->rowCount();
				$numRows = $numRows - 3;
				foreach($artifactList as $artifact){
					if($count % 3 == 0){
						echo "<div class='grids_of_3'>";				
					}
					$id = $artifact['artifact_id'];
					$title = $artifact['title'];
					$price = $artifact['retail_price'];
					
					$promotionDAO = new promotions();
					$promotionRow = $promotionDAO->hasPromotion($id);
					if($promotionRow->rowCount() > 0){
						$newPrice = $promotionRow->fetch();
						$price = "<span class='strikethrough'>".$price." </span>".$newPrice['new_price'];
					}
					?>
					<div class="grid1_of_3">
						<a href="details.php?aid=<?php echo $id ?>">
							<?php 
								$artifactImageDao = new artifactimagepath();
								$artifactImage = $artifactImageDao->getImageByID($id);
								$imageURL = $artifactImage->fetch();
							?>
							<img src="<?php echo $dbRoot.$imageURL['image_path'] ?>" alt=""/>
							<h3><?php echo $title ?></h3>
							<div class="price">
								<h4><?php echo "NRs.".$price ?><span>buy</span></h4>
							</div>
							<span class="b_btm"></span>
						</a>
					</div>
					<?php
					$count++;
					if($count % 3 == 0 || $count==$numRows){
						echo "<div class='clear'></div></div>";
					}
				}
				?>
				<!--end of grids_of_3-->
			</div>
		</div>
	</div>	

	<?php include_once('../includes/footer.php'); ?>
</body>
</html>