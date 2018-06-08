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

	include_once("../class/wishlist.class.php");
	include_once("../class/promotions.class.php");
	include_once('validateUser.php');
	
	$customer_id = $_SESSION['customer_id'];
	
	if(isset($_GET['aid'])){
		$artifact_id = $_GET['aid'];
		$wishlist = new wishlist();
		$deleteWishItem = $wishlist->deleteFromWishlist($customer_id, $artifact_id);
		$res = $deleteWishItem->rowCount();
		if($res == 1){
			echo "<script>alert('Deleted')</script>";
		} else {
			header('location:wishlist.php');
		}
	} 
?>




<!DOCTYPE HTML>
<html>
<head>
	<title>Wishlist</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="../css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS 
    <link href="../css/dataTables.responsive.css" rel="stylesheet">-->  
    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
<?php 
	include_once('../includes/css.php'); 	
?>

	<style>
		a:hover{
			text-decoration:none;
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
			<!--<h2 class="style top">Checkout</h2>-->	
		</div>
	</div>
</div>	

<div class="container-fluid">
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Wishlist</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Artifact</th>
								<th>Retail Price</th>
								<th>Added On</th>
								<th>Promotions</th>
								<th>Remove from List</th>
							</tr>
						</thead>
						<tbody style="text-align:center">
							<?php
								$wishlist = new wishlist();
								$wish = $wishlist->getWishlistByID($customer_id);
								
								foreach($wish as $wishItem){
									$artifact_id = $wishItem['artifact_id'];
									$price = $wishItem['retail_price'];
									$artifact = $wishItem['title'];
									$added = $wishItem['add_time'];
									
									// Get Promotional Information about Artifact
									$promotions = new promotions();
									$hasPromotion = $promotions->hasPromotion($artifact_id)->rowCount();
									$promo = "None";
									if($hasPromotion>0){
										$promo = "On Sale";
									}
									?>		
									<tr class="odd gradeX">
										<td><a target="_blank" href="details.php?aid=<?php echo $artifact_id ?>"><?php echo $artifact ?></td>
										<td><?php echo $price ?></td>
										<td><?php echo $added ?></td>
										<td><?php echo $promo." ".$hasPromotion['new_price']."<a target='_blank' href='details.php?aid=".$artifact_id."'>(View)</a>" ?></td>
										<td><a href="wishlist.php?aid=<?php echo $artifact_id ?>">Delete</a></td>
									</tr>
								<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
</div>
<!-- start footer -->
<?php
include_once('../includes/js.php');
include_once('../includes/footer.php');
?>		

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	<script src="../js/metisMenu.min.js"></script>
	<script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap.min.js"></script>
	<script src="../js/easing.js"></script>
	<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
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

