<?php
    require_once("../../class/artifact.class.php");
	include_once('../../class/vendor.class.php');
    session_start();

	include_once('../includes/check_permission.php');
	
    if(!isset($_GET["id"])) {
        header("Location: artifact.php");
    }

    $artifactDAO = new artifact();
    $artifactData = $artifactDAO->getArtifactByID($_GET["id"]);

    if($artifactData->rowCount() == 1) {
        $artifact = $artifactData->fetch();
    } else {
        $header("Location: artifact.php");
    }
	
	$vendorDAO = new vendor();
	$vendorList = $vendorDAO->getAllVendors();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Edit Artifact</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $artifact['title'] ?></h1>
                        <div class="panel-body">
                            <form role="form" action="save_artifact.php" method="POST">
                                <input class="form-control" name="id" type="hidden" value="<?php echo $artifact["artifact_id"]; ?>">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" name="title" type="title" value="<?php echo $artifact["title"]; ?>" autofocus>
                                    </div>
									<div class="form-group">
                                        <input class="form-control" placeholder="price" name="retail_price" value="<?php echo $artifact["retail_price"]; ?>" type="retail_price">
                                    </div>
                                    <div class="form-group">
										<select class="form-control" name="artifact_type" readonly>
											<option>---Select One---</option>
											<?php 
												$artifact_type =  $artifact['artifact_type']; 
												if(strcasecmp($artifact_type,"khukuri")==0){
											?>
												<option selected="selected">Khukuri</option>
											<?php } else { ?>
												<option>Khukuri</option>
											<?php } ?>
											<?php 
												if(strcasecmp($artifact_type,"thangka")==0){
											?>
												<option selected="selected">Thangka</option>
											<?php } else { ?>
												<option>Thangka</option>
											<?php } ?>
											<?php 
												if(strcasecmp($artifact_type,"singing bowl")==0){
											?>
												<option selected="selected">Singing Bowl</option>
											<?php } else { ?>
												<option>Singing Bowl</option>
											<?php } ?>
										</select>
                                    </div>
									<div class="form-group">
										<textarea class="form-control" rows="5" name="description"><?php echo $artifact["description"]; ?></textarea>
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
