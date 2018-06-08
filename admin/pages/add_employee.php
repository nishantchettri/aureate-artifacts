<?php
    session_start();
	include_once('../../class/permissions.class.php');
	include_once('../../class/store.class.php');
	include_once('../includes/check_permission.php');
	
	$permissionDAO = new permission();
	$permissions = $permissionDAO->getAllPermissions();
	if($permissions->rowCount() == 0) {
        $header("Location: employee.php");
    }
	
	$storeDAO = new store();
	$stores = $storeDAO->getAllStores();
	if($stores->rowCount() == 0) {
        $header("Location: employee.php");
    }

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Add Employee</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Employee</h1>
                        <div class="panel-body">
                            <form role="form" action="save_new_employee.php" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="First Name" name="fname" type="text" autofocus>
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Last Name" name="lname" type="text" >
                                    </div>
									<div class="form-group">
                                        <select class="form-control" name="position">
											<option value="0">--- Assign Position ---</option>
											<option>Super Admin</option>
											<option>Admin</option>
											<option>Manager</option>
											<option>Sales</option>
										</select>
                                    </div>
									<div class="form-group">
                                        <select class="form-control" name="permission">
											<option value="0">--- Assign Permission ---</option>
											<?php foreach ($permissions as $permission){?>
											<option value="<?php echo $permission['permission_id'] ?>"><?php echo $permission['permission_level'] ?></option>
											<?php } ?>
										</select>
                                    </div>
									<div class="form-group">
                                        <select class="form-control" name="store">
											<option value="0">--- Works In ---</option>
											<?php foreach ($stores as $store){?>
											<option value="<?php echo $store['store_id'] ?>"><?php echo $store['store_name'] ?></option>
											<?php } ?>
										</select>
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Since (YYYY-MM-DD)" name="start_date" type="text" >
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Salary" name="salary" type="text" >
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Email Address (will be username)" name="email" type="title" >
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Password" name="pass1" type="password" style="display:none">
										<input class="form-control" placeholder="Password" name="pass1" type="password" >
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Confirm Password" name="pass2" type="password" style="display:none">
										<input class="form-control" placeholder="Confirm Password" name="pass2" type="password" >
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
    <?php include_once ('../includes/js.php') ?>

</body>

</html>
