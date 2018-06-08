<?php
	session_start();
	require_once('../../class/connect.class.php');
    require_once("../../class/artifact.class.php");
	include_once('../includes/check_permission.php');
	
    $artifactsData = new artifact();
    $artifacts = $artifactsData->getAllArtifacts()->fetchAll();

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include_once ('../includes/css.php'); ?>
    <title>Artifact Management</title>
</head>

<body>
    <div id="wrapper">
        <?php require('../includes/navbar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Artifacts <a href="add_artifact.php"><button class="btn btn-default" type="button">Add Artifact</button></a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List of all Artifacts
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <td style="width:20%;">Name</td>
                                            <td style="width:40%;">Description</td>
                                            <td style="width:15%;">Price (in NRs.)</td>
											<td style="width:15%">Type</td>
                                            <td style="width:10%;">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($artifacts as $artifact) {
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo $artifact["title"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $artifact["description"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $artifact["retail_price"];
                                                    echo "</td>";
													echo "<td>";
                                                        echo ucfirst($artifact["artifact_type"]);
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo  "<a href='edit_artifact.php?id=".$artifact["artifact_id"]."'><button type='button' class='btn btn-default'>Edit</button></a>";
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	<?php include_once ('../includes/js.php'); ?>
</body>
</html>
