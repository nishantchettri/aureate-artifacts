<?php
    session_start();
	include_once('../includes/check_permission.php');
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Add Store</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Store</h1>
                        <div class="panel-body">
                            <form role="form" action="save_new_store.php" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Store Name" name="name" type="text" autofocus>
                                    </div>
									<div class="form-group">
                                        <select class="form-control" placeholder="" name="store_type" type="store_type">
											<option value="0">--- Select Store Type ---</option>
											<option>Shop</option>
											<option>Warehouse</option>
										</select>
                                    </div>
                                    <!-- ADDRESS -->
									<div class="form-group">
                                        <input class="form-control" placeholder="Street 1" name="addr1" type="text" >
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Street 2" name="addr2" type="text">
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="City" name="city" type="text" >
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="State" name="state" type="text" >
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Country" name="country" type="text" >
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Postcode" name="postcode" type="text" >
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
