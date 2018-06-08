<?php
    session_start();
	include_once('../includes/check_permission.php');
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Add Promotions</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Promotion</h1>
                        <div class="panel-body">
                            <form role="form" action="save_new_promotion.php" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Title" name="title" type="title" autofocus>
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Discount" name="discount" type="text">
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Start Date (YYYY-MM-DD)" name="start_date" type="text" />
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="End Date (YYYY-MM-DD)" name="end_date" type="text" />
                                    </div>
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
