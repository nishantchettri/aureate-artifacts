<?php
	include_once('../class/connect.class.php');
	include_once('../class/artifact.class.php');
	include_once('../class/khukuri.class.php');
	include_once('../class/thangka.class.php');
	include_once('../class/bowl.class.php');
	$artifact = new artifact();
	$getDecorList = $artifact->getAllArtifacts();
	$khuk = new khukuri();
	$getKhukuriList = $khuk->getKhukuriWithName();
	$than = new thangka();
	$getThangkaList = $than->getThangkaWithName();
	$bowls = new bowl();
	$getBowlList = $bowls->getBowlWithName();
	//foreach($getDecorList as $decor){
		//echo $decor['title'];
	//}

?>

<div class="footer_bg" style="bottom:0; ">
<div class="wrap">	
	<div class="footer">
		<!-- start grids_of_4 -->	
		<div class="grids_of_4">
			<div class="grid1_of_4">
				<h4>Best of all</h4>
				<ul class="f_nav">
				<?php 
				$count = 0;
				foreach($getDecorList as $decor){ ?>
					<li><a href=""><?php echo $decor['title']; ?></a></li>
					<?php 
					$count++;
					if($count == 4){
						break;
					}
				} ?>
				</ul>
			</div>
			<div class="grid1_of_4">
				<h4>Khukuri</h4>
				<ul class="f_nav">
				<?php 
				$count = 0;
				foreach($getKhukuriList as $khukuri){ ?>
					<li><a href=""><?php echo $khukuri['title']; ?></a></li>
					<?php 
					$count++;
					if($count == 4){
						break;
					}
				} ?>
				</ul>
			</div>
			<div class="grid1_of_4">
				<h4>Thangka</h4>
				<ul class="f_nav">
				<?php 
				$count = 0;
				foreach($getThangkaList as $thangka){ ?>
					<li><a href=""><?php echo $thangka['title']; ?></a></li>
					<?php 
					$count++;
					if($count == 4){
						break;
					}
				} ?>
				</ul>
			</div>
			<div class="grid1_of_4">
				<h4>Bowl</h4>
				<ul class="f_nav">
				<?php 
				$count = 0;
				foreach($getBowlList as $bowl){ ?>
					<li><a href=""><?php echo $bowl['title']; ?></a></li>
					<?php 
					$count++;
					if($count == 4){
						break;
					}
				} ?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
</div>

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