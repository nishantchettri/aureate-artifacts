<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Aureate Artifacts</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
				<li><a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                <li><a href="artifact.php"><i class="fa fa-paint-brush fa-fw"></i> Artifacts</a></li>
                <li><a href="employee.php"><i class="fa fa-user fa-fw"></i> Employees</a></li>
				<li><a href="promotion.php"><i class="fa fa-usd fa-fw"></i> Promotions</a></li>
				<li><a href="courier.php"><i class="fa fa-male fa-fw"></i> Couriers</a></li>
				<li><a href="store.php"><i class="fa fa-home fa-fw"></i> Store</a></li>
				<li><a href="vendor.php"><i class="fa fa-truck fa-fw"></i> Suppliers</a></li>
				<li><a href="#"><i class="fa fa-file-text fa-fw"></i> Reports<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="popular.php">Popular Artifacts</a></li>
						<li><a href="#">Sales Reports <span class="fa arrow"></span></a>
							<ul class="nav nav-third-level">
                                <li><a href="sales_by_item.php">By Artifact</a></li>
                                <li><a href="sales_by_item_type.php">By Artifact Type</a></li>
                                <li><a href="sales_by_location.php">By Location</a></li>
                                <li><a href="sales_by_employee.php">By Employee</a></li>
								<li><a href="sales_per_hour.php">Hourly Average</a></li>
								<li><a href="sales_per_day.php">Daily Reports</a></li>
                            </ul>
                        </li>
                        <li><a href="profits.php">Profits <span class="fa arrow"></a>
							<ul class="nav nav-third-level">
                                <li><a href="profit_by_supplier.php">By Supplier</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
