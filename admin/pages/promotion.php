<?php
	session_start();
	require_once('../../class/connect.class.php');
	require_once("../../class/promotions.class.php");
	require_once("../includes/check_permission.php");
    $promotionDao = new promotions();
    $promotion = $promotionDao->getAllPromotions()->fetchAll();


 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('../includes/css.php'); ?>
	<title>Promotion Management</title>

</head>

<body>

    <div id="wrapper">

        <?php require('../includes/navbar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Promotion <a href="add_promotion.php"><button class="btn btn-default" type="button">Add Promotion</button></a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Promotions
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
                                                Description
                                            </td>
                                            <td>
                                                Discount
                                            </td>
                                            <td>
                                                Start Date
                                            </td>
											<td>
                                                End Date
                                            </td>
											<td>
												Action
											</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($promotion as $promotion) {
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo $promotion["title"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $promotion["description"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo (1 - $promotion["discount"])*100 . "%";
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $promotion["start_time"];
                                                    echo "</td>";
													echo "<td>";
                                                        echo $promotion["end_time"];
                                                    echo "</td>";
													echo "<td>";
                                                        echo  "<a href='edit_promotion.php?id=".$promotion["promotion_id"]."'><button type='button' class='btn btn-default'>Edit</button></a>";
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

    <?php include_once('../includes/js.php'); ?>

</body>

</html>
