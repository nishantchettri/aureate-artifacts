<?php
    session_start();
	include_once('../../class/vendor.class.php');
	include_once('../includes/check_permission.php');

	$vendorDAO = new vendor();
	$vendorList = $vendorDAO->getAllVendors();

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../includes/css.php'); ?>
	<title>Add Artifact</title>
</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Artifact</h1>
                        <div class="panel-body">
                            <form role="form" action="save_new_artifact.php" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Title" name="title" type="title" autofocus>
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Price" name="retail_price" type="number" min="1">
                                    </div>
									<div class="form-group">
                                        <select class="form-control" placeholder="" name="artifact_type" type="artifact_type">
											<option value="0">---Select Artifact--</option>
											<option value="khukuri">Khukuri</option>
											<option value="thangka">Thangka</option>
											<option value="bowl">Singing Bowl</option>
										</select>
                                    </div>
									<!--<div class="form-group">
                                        <select class="form-control" name="supplier">
											<option value="0">---Select Vendor--</option>
											<?php /*foreach($vendorList as $vendorInfo){ ?>
												<option value="<?php echo $vendorInfo['vendor_id']; ?>"><?php echo $vendorInfo['vendor_name']; ?></option>
											<?php }*/ ?>
										</select>
                                    </div>-->
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Description" name="description" rows=5></textarea>
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" class="btn btn-lg btn-success btn-block">Save</button>
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
