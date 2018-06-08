<?php
    session_start();
	include_once('../../class/employee.class.php');
	include_once('../../class/permissions.class.php');
	include_once('../../class/store.class.php');
	include_once('../../class/works.class.php');
	include_once('../includes/check_permission.php');	
    	
	if(!isset($_GET["id"])){
        header("Location: employee.php");
    }
	
	// Get Permission Select
	$permissionDAO = new permission();
	$permissions = $permissionDAO->getAllPermissions();
	if($permissions->rowCount() == 0) {
        header("Location: employee.php");
    }
	
	// Get Store Select
	$storeDAO = new store();
	$stores = $storeDAO->getAllStores();
	if($stores->rowCount() == 0) {
        header("Location: employee.php");
    }
	
	// Get Employee Table Info
	$employeeDAO = new employee();
    $employeeData = $employeeDAO->getEmployeeByID($_GET["id"]);
    if($employeeData->rowCount() == 1) {
        $employee = $employeeData->fetch();
    } else {
        header("Location: employee.php");
    }
	
	$employeeID = $employee['employee_id'];
	
	// Get Works In Info
	$works = new works();
	$currentStore = $works->getCurrentStore($employeeID);
	if($currentStore->rowCount() == 1) {
        $working = $currentStore->fetch();
    } else {
        header("Location: employee.php");
    }

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Edit Employee</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $employee['fname']." ". $employee['lname'] ?></h1>
                        <div class="panel-body">
                            <form role="form" action="save_employee.php" method="POST">
								<input class="form-control" name="id" type="hidden" value="<?php echo $employee['employee_id'] ?>" />
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="First Name" name="fname" type="text" value="<?php echo $employee['fname'] ?>" readonly>
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Last Name" name="lname" type="text" value="<?php echo $employee['lname'] ?>" readonly>
                                    </div>
									<div class="form-group">
                                        <select class="form-control" name="position">
											<option value="0">--- Assign Position ---</option>
											<?php 
												$position =  $employee['position']; 
												if(strcasecmp($position,"Super Admin")==0){
											?>
												<option selected="selected">Super Admin</option>
											<?php } else { ?>
												<option>Super Admin</option>
											<?php } ?>
											<?php 
												if(strcasecmp($position,"Admin")==0){
											?>
												<option selected="selected">Admin</option>
											<?php } else { ?>
												<option>Admin</option>
											<?php } ?>
											<?php 
												if(strcasecmp($position,"Manager")==0){
											?>
												<option selected="selected">Manager</option>
											<?php } else { ?>
												<option>Manager</option>
											<?php } ?>
											<?php 
												if(strcasecmp($position,"Sales")==0){
											?>
												<option selected="selected">Sales</option>
											<?php } else { ?>
												<option>Sales</option>
											<?php } ?>
										</select>
                                    </div>
									<div class="form-group">
                                        <select class="form-control" name="permission">
											<option value="0">--- Assign Permission ---</option>
											<?php 
												foreach ($permissions as $permission){
													$permission_id = $employee['permission_id'];
													if ($permission_id == $permission['permission_id']){
													?>
													<option value="<?php echo $permission['permission_id'] ?>" selected><?php echo $permission['permission_level'] ?></option>
													<?php } else{ ?>
														<option value="<?php echo $permission['permission_id'] ?>"><?php echo $permission['permission_level'] ?></option>
													<?php }
												} ?>
										</select>
                                    </div>
									<div class="form-group">
                                        <select class="form-control" name="store">
											<option value="0">--- Works In ---</option>
											<?php 
												foreach ($stores as $store){
													$store_id = $working['store_id'];
													if($store_id == $store['store_id']){
											?>
														<option value="<?php echo $store['store_id'] ?>" selected><?php echo $store['store_name'] ?></option>
											<?php } else { ?>
												<option value="<?php echo $store['store_id'] ?>"><?php echo $store['store_name'] ?></option>
											<?php }
												}
											?>
										</select>
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Since (YYYY-MM-DD)" name="start_date" type="text" value="<?php echo $working['work_date'] ?>"  >
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Salary" name="salary" type="text" value="<?php echo $employee['salary'] ?>">
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="Email Address (will be username)" name="email" type="title" value="<?php echo $employee['username'] ?>" readonly>
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
    <?php include_once ('../includes/js.php') ?>

</body>

</html>
