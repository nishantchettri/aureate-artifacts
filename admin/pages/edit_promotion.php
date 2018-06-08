<?php
    require_once("../../class/connect.class.php");
	require_once("../../class/promotions.class.php");
    session_start();

	include_once('../includes/check_permission.php');
	
    if(!isset($_GET["id"])) {
        header("Location: promotion.php");
    }

    $promotionDAO = new promotions();
    $promotionData = $promotionDAO->getPromotionsByID($_GET["id"]);

    if($promotionData->rowCount() == 1) {
        $promotion = $promotionData->fetch();
    } else {
        $header("Location: promotion.php");
    }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Edit Promotion</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $promotion['title'] ?></h1>
                        <div class="panel-body">
                            <form role="form" action="save_promotion.php" method="POST">
                                <input class="form-control" name="id" type="hidden" value="<?php echo $promotion["promotion_id"]; ?>">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Title" name="title" type="title" value="<?php echo $promotion['title'] ?>" autofocus>
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Discount" name="discount" type="text" min="0" max="100" value="<?php echo (1 - $promotion['discount']) * 100 ?>">
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Start Date (YYYY-MM-DD)" name="start_date" type="text" value="<?php echo $promotion['start_time'] ?>"/>
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="End Date (YYYY-MM-DD)" name="end_date" type="text" value="<?php echo $promotion['end_time'] ?>" />
                                    </div>
									<div class="form-group">
                                        <textarea class="form-control" placeholder="Description" name="description" rows=5><?php echo $promotion['description'] ?></textarea>
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" name="save" class="btn btn-lg btn-success ">Save</button>
									<button type="submit" name="delete" class="btn btn-lg btn-danger ">Delete</button>
                                </fieldset>
                            </label>
                            </form>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <?php include_once('../includes/js.php'); ?>

</body>

</html>
