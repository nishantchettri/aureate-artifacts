<?php
	require_once("../../class/connect.class.php");
	require_once("../../class/vendor.class.php");
	require_once("../../class/address.class.php");
	
    session_start();

	include_once('../includes/check_permission.php');
    if(!isset($_GET["id"])) {
        header("Location: vendor.php");
    }

    $vendorDAO = new vendor();
    $vendorData = $vendorDAO->getVendorByID($_GET["id"]);

    if($vendorData->rowCount() == 1) {
        $vendor = $vendorData->fetch();
    } else {
        $header("Location: vendor.php");
    }
	
	$addressDAO = new address();
	$addressData = $addressDAO->getAddressByID($vendor['addr_id']);
	if($addressData->rowCount() == 1) {
        $address = $addressData->fetch();
    } else {
        $header("Location: vendor.php");
    }

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Add Supplier</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $vendor['vendor_name']; ?></h1>
                        <div class="panel-body">
                            <form role="form" action="save_vendor.php" method="POST">
								<input class="form-control" name="vid" type="hidden" value="<?php echo $vendor['vendor_id']; ?>">
								<input class="form-control" name="aid" type="hidden" value="<?php echo $vendor['addr_id']; ?>">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Name" name="name" type="text" autofocus value="<?php echo $vendor['vendor_name']; ?>">
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Contact Info" name="contact" type="text" value="<?php echo $vendor['contact']; ?>">
                                    </div>
									<!-- ADDRESS -->
									<div class="form-group">
                                        <input class="form-control" placeholder="Street 1" name="addr1" type="text" value="<?php echo $address['addr_street1'] ?>">
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Street 2" name="addr2" type="text" value="<?php echo $address['addr_street2'] ?>">
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="City" name="city" type="text" value="<?php echo $address['addr_city'] ?>">
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="State" name="state" type="text" value="<?php echo $address['addr_state'] ?>">
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Country" name="country" type="text" value="<?php echo $address['addr_country'] ?>">
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Postcode" name="postcode" type="text" value="<?php echo $address['addr_postcode'] ?>">
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
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
