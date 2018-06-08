<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Thangka</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php 
	session_start();
	include_once('../includes/css.php'); 
	include_once('../includes/js.php');

	include_once('../class/thangka.class.php');
	include_once('../class/artifactimagepath.class.php');
	include_once('../class/promotions.class.php');
	
	$getThangka = new thangka();
	$thangkaList = $getThangka->getAllThangkas();
	
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
		<h2 class="style top">featured thangkas</h2>
		<!-- start grids_of_3 -->
		<?php
		$count=0;
		$numRows = $thangkaList->rowCount();
		foreach($thangkaList as $thangka){
			if($count % 3 == 0){
				echo "<div class='grids_of_3'>";				
			}
			$id = $thangka['artifact_id'];
			$title = $thangka['artifact_title'];
			$price = $thangka['retail_price'];
			
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
					<img src="<?php echo $dbRoot.$imageURL['image_path'] ?>" alt="" />
					<h3><?php echo $title ?></h3>
					<div class="price">
						<h4><?php echo "NRs. ".$price ?><span>buy</span></h4>
					</div>
					<span class="b_btm"></span>
				</a>
			</div>
			<?php
			$count++;
			if($count % 3 == 0 || $count==$numRows){
				echo "<div class='clear'></div></div>";				
			}
		}?>
		<!-- end grids_of_3 -->
	</div>
</div>
</div>	
<!-- start footer -->
<?php
include_once('../includes/footer.php');
?>	
<!-- start footer -->
<div class="footer_bg1">
<div class="wrap">
	<div class="footer">
		<!-- scroll_top_btn -->
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
		 <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
		<!--end scroll_top_btn -->
		<div class="copy">
			<p class="link">&copy;  All rights reserved | Template by&nbsp;&nbsp;<a href="http://w3layouts.com/"> W3Layouts</a></p>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
</body>
</html>