<?php
    require_once("../../class/courier.class.php");
    session_start();

	include_once('../includes/check_permission.php');
	
    if(!isset($_GET["name"])) {
        header("Location: courier.php");
    }

    $courierDAO = new courier();
    $courierData = $courierDAO->getCourierByName($_GET["name"]);

    if($courierData->rowCount() == 1) {
        $courier = $courierData->fetch();
    } else {
        header("Location: courier.php");
    }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Edit Courier</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $courier['courier_name'] ?></h1>
                        <div class="panel-body">
                            <form role="form" action="save_courier.php" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Name" name="name" type="text" value="<?php echo $courier["courier_name"]; ?>" readonly>
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Contact Info" name="contact" value="<?php echo $courier["contact"]; ?>" type="text" autofocus>
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Price" name="fee" value="<?php echo $courier["fee"]; ?>" type="text">
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
