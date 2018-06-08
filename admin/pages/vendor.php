<?php
	session_start();
	require_once("../includes/check_permission.php");
	require_once('../../class/connect.class.php');
	require_once("../../class/vendor.class.php");
	require_once("../../class/address.class.php");

    $vendorDao = new vendor();
    $vendors = $vendorDao->getAllvendors()->fetchAll();


 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Supplier Management</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Suppliers <a href="add_vendor.php"><button class="btn btn-default" type="button">Add Supplier</button></a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Suppliers
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <td>
                                                Name
                                            </td>
                                            <td>
                                                Contact
                                            </td>
                                            <td>
                                                Address
                                            </td>
											<td>
												Action
											</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($vendors as $vendor) {
												$address_id = $vendor['addr_id'];
												$addressDao = new address();
												$address = $addressDao->getAddressByID($address_id)->fetch();
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo $vendor["vendor_name"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $vendor["contact"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $address["addr_city"]." - ".$address["addr_country"];
                                                    echo "</td>";
													echo "<td>";
                                                        echo  "<a href='edit_vendor.php?id=".$vendor["vendor_id"]."'><button type='button' class='btn btn-default'>Edit</button></a>";
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
    <?php include_once('../includes/js.php'); ?>
</body>

</html>
