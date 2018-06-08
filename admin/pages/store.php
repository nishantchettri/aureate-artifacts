<?php
	session_start();
	require_once("../includes/check_permission.php");
	require_once('../../class/connect.class.php');
	require_once("../../class/store.class.php");
	require_once("../../class/address.class.php");
	require_once("../../class/artifact.class.php");

    $storeDao = new store();
    $stores = $storeDao->getAllstores()->fetchAll();

    $artifactsData = new artifact();
    $artifacts = $artifactsData->getAllArtifacts()->fetchAll();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <?php include_once('../includes/css.php'); ?>
   <title>Store Management</title>
</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Stores <a href="add_store.php"><button class="btn btn-default" type="button">Add Store</button></a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Stores
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <td width="35%">
                                                Name
                                            </td>
                                            <td width="25%">
                                                Address
                                            </td>
                                            <td>
                                                Type
                                            </td>
											<td>
												Action
											</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($stores as $store) {
												$address_id = $store['addr_id'];
												$addressDao = new address();
												$address = $addressDao->getAddressByID($address_id)->fetch();
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo $store["store_name"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $address["addr_city"]." - ".$address["addr_country"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $store["store_type"];
                                                    echo "</td>";
													echo "<td>";
                                                        echo  "<a href='edit_store.php?id=".$store["store_id"]."'><button type='button' class='btn btn-default'>Edit</button></a>";
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

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
