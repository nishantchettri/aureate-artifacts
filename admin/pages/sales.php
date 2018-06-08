<?php
	session_start();
	require_once('../../class/connect.class.php');
	require_once("../../class/artifact.class.php");
	require_once("../includes/check_permission.php");
    $artifactDao = new artifact();
    $artifacts = $artifactDao->getPopularArtifacts()->fetchAll();


 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Popular Artifacts</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Popular Artifacts</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Artifact Listing
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <td>
                                                Title
                                            </td>
                                            <td>
                                                Times Purchased
                                            </td>
                                            <td>
                                                Times Wishlisted
                                            </td>
											<td>
												Times Browsed
											</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($artifacts as $artifact) {
												$artifact_id = $artifact['artifact_id'];
												$artifactTitleDao = new artifact();
												$artifactTitle = $artifactTitleDao->getArtifactByID($artifact_id)->fetch();
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo $artifactTitle["title"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $artifact["num_purchase"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $artifact["num_wishlist"];
                                                    echo "</td>";
													echo "<td>";
                                                        echo $artifact["num_browsed"];
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
                                         ?>
                                    </tbody>
                                </table>
                                <!--<a href="add_artifact.php"><button class="btn btn-default" type="button">Add artifact</button></a>-->
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

    <!-- jQuery -->
    <?php include_once('../includes/js.php'); ?>
</body>

</html>
