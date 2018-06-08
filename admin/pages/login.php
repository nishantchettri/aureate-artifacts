<?php
    require_once('../../config.php');
    require('../../class/employee.class.php');
    session_start();

    if(isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $employeeDao = new employee($dbAddress, $db, $dbUsername, $dbPassword);
        $results = $employeeDao->getEmployeeByUsername($username);
        if($results->rowCount() >= 1) {
            $resultsArray = $results->fetch();
            $saltedPassword = $password . $resultsArray["salt"];
            $finalPassword = hash("sha256", $saltedPassword);
            if($finalPassword == $resultsArray["password"]) {
                $_SESSION['username'] = $username;
                $_SESSION['permission_level'] = $resultsArray["permission_id"];
                header("Location: index.php");
				exit();
            }else {
				header('location:login.php?err=per');
			}
        } else {
			header('location:login.php?err=per');
		}
    }
	
	$error = 0;
	if(isset($_GET['err'])){
		$err = $_GET['err'];
	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once ('../includes/css.php'); ?>
	<title>Admin Panel</title>
	<style>
		.error h3{
			text-align:center;
			background-color:rgba(207, 76, 76, 0.88);
			color:white;
			margin-top:50px;
			font-size:25px;
			padding:10px 0;
		}
	</style>
</head>

<body>
    <div class="container">
		<div class="row">
            <div class="col-md-4 col-md-offset-4">
				<?php if(isset($_GET['err']) && strcasecmp($err,"per")==0){ ?>
				<div class="error">
					<h3>PERMISSION DENIED</h3>
				</div>
				<?php } ?>
				<div class="login-panel panel panel-default" style="margin-top:10px">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <?php include_once('../includes/js.php'); ?>

</body>

</html>
